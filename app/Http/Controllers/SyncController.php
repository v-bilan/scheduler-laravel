<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\TaskWitnessDate;
use App\Models\User;
use App\Models\Witness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SyncController extends Controller
{

    const API_HOST = 'http://scheduler.symfony';

    public function __invoke()
    {
        $this->roles();
        $this->witnesses();
        $this->tasks();
        return redirect()->route('home')->with('success', __('Data synchronized successfully.'));
    }

    private function tasks()
    {

        $url =  '/api/task_witness_dates?page=1';
        do {
            echo $url, '<hr>';
            $response = Http::get(self::API_HOST . $url);
            if ($response->status() != 200) break;
            $json = $response->json();
            $this->syncTasks($json['hydra:member']);
        } while ($url = $json['hydra:view']['hydra:next'] ?? null);
    }


    private function roles()
    {
        $response = Http::get(self::API_HOST . '/api/roles');
        if ($response->status() == 200 && $response->json()['hydra:member']) {
            $this->syncRoles($response->json()['hydra:member']);
        }
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

    private function witnesses()
    {
        $response = Http::get(self::API_HOST . '/api/witnesses');
        if ($response->status() == 200 && $response->json()['hydra:member']) {
            $this->syncWitneses($response->json()['hydra:member']);
        }
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
