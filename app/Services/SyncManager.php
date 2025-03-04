<?php

namespace App\Services;

use App\Models\Role;
use App\Models\TaskWitnessDate;
use App\Models\Witness;
use Illuminate\Support\Facades\Http;

class SyncManager
{
    const API_HOST = 'http://scheduler.symfony';

    private $isRolesSync = false;
    private $isTasksSync = false;
    private $isWitnessesSync = false;

    public function tasks($force = false)
    {

        if ($this->isTasksSync && ! $force)
        {
            return;
        }
        if (!$this->isWitnessesSync) {
            $this->witnesses($force);
        }

        $url =  '/api/task_witness_dates?page=1';
        do {
            $response = Http::get(self::API_HOST . $url);
            if ($response->status() != 200) break;
            $json = $response->json();
            $this->syncTasks($json['hydra:member']);
        } while ($url = $json['hydra:view']['hydra:next'] ?? null);
        $this->isTasksSync = true;
    }


    public function roles($force = false)
    {
        if ($this->isRolesSync && !$force) {
            return;
        }
        $response = Http::get(self::API_HOST . '/api/roles');
        if ($response->status() == 200 && $response->json()['hydra:member']) {
            $this->syncRoles($response->json()['hydra:member']);
        }
        $this->isRolesSync = true;
    }

    private function syncTasks($tasks)
    {
        foreach ($tasks as $task) {
            $task['role_id'] = $this->getId($task['Role']);
            $task['witness_id'] = $this->getId($task['Witness']);
            $task['date'] = date('Y-m-d', strtotime($task['date']));
            TaskWitnessDate::updateOrCreate(['id' => $task['id']], $task);
        }
    }

    private function syncRoles($roles)
    {
        if (!is_array($roles)) return false;

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);;
        }
        return true;
    }

    public function witnesses($force =false)
    {
        if ($this->isWitnessesSync && !$force) {
            return;
        }
        if (!$this->isRolesSync) {
            $this->roles($force);
        }
        $response = Http::get(self::API_HOST . '/api/witnesses');
        if ($response->status() == 200 && $response->json()['hydra:member']) {
            $this->syncWitneses($response->json()['hydra:member']);
        }
        $this->isWitnessesSync = true;
    }

    private function syncWitneses($witnesses)
    {
        foreach ($witnesses as $witness) {
            $witnessObj = Witness::updateOrCreate(['id' => $witness['id']], $witness);
            $witnessObj->roles()->sync($this->getRoles($witness));
        }
    }

    private function getRoles($witness): array
    {
        $roles = [];
        foreach ($witness['Roles'] ?? [] as $role) {
            $roles[] = $this->getId($role);
        }
        return $roles;
    }

    private function getId($url)
    {
        $data = explode('/', $url);
        return end($data);
    }
}
