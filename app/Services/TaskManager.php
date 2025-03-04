<?php

namespace App\Services;

use App\Models\Role;
use App\Models\TaskWitnessDate;
use App\Models\Witness;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class TaskManager
{
    /**
     * Create a new class instance.
     */

    private $witnessesByRole  = [];

    public function __construct(private TasksParser $tasksParser) {}

    private function getWitnessesByRole(string $role, $date)
    {
        if (!isset($this->witnessesByRole[$role])) {
            $this->witnessesByRole[$role] = DB::table('witnesses')->select([
                'witnesses.full_name',
                'roles.name as role_name',
                'roles.id as role_id',
                DB::raw('max(task_witness_date.date) as last_date')
            ])
                ->join('role_witness', 'witnesses.id', '=', 'role_witness.witness_id')
                ->join('roles', 'role_witness.role_id', '=', 'roles.id')
                ->leftJoin('task_witness_date', function (JoinClause $join) use ($date) {
                    $join->on('witnesses.id', '=', 'task_witness_date.witness_id')
                        ->on('roles.id', '=', 'task_witness_date.role_id')
                        ->where('task_witness_date.date', '<', $date);
                })
                ->where('roles.name', '=', $role)
                ->groupBy(['witnesses.full_name', 'roles.id', 'roles.name'])
                ->orderBy('last_date')
                ->get();
        }


        return $this->witnessesByRole[$role];
    }

    private function combine($rawTasks, $dbTasks): array
    {
        foreach ($dbTasks as $task) {
            $rawTasks[$task->task]['witness'] = $task->witness->full_name;
        }
        return $rawTasks;
    }


    public function getTasksData($date): array
    {
        $year = $date->getFullYear();
        $week = $date->getWeek();

        $rawTasks = $this->getTasksDataFromTasks($this->tasksParser->getTasks($year, $week));

        $dbTasks = TaskWitnessDate::with('witness')->where('date', '=',  $date)->get();

        $roles = Role::orderBy('priority', 'DESC')->pluck('priority', 'name')->toArray();

        $result = $this->combine($rawTasks, $dbTasks);

        foreach ($result as &$task) {
            $task['priority'] = $roles[$task['role']] ?? 0;
            $task['witnesses'] = $this->getWitnessesByRole($task['role'], $date);
        }

        //dd($result);
        return $result;
    }

    public function getDateString(int $year, int $week)
    {
        return $this->tasksParser->getDate($year, $week);
    }

    private function getTasksDataFromTasks(array $tasks): array
    {
        $result = [
            'leader' => [
                'label' => 'Ведучий',
                'role' => 'Ведучий'
            ],
            'first_pray' => [
                'label' => 'Початкова молитва',
                'role' => 'Молитва'
            ],
        ];

        foreach ($tasks as $key => $task) {
            $result['task' . ($key + 1)] = [
                'label' => $task,
                'role' => $this->getRoleNameByTaskName($task)
            ];
        }
        $result['reader'] = [
            'label' => 'Читець',
            'role' => 'Читець'
        ];
        $result['last_pray'] = [
            'label' => 'Кінцева молитва',
            'role' => 'Молитва'
        ];

        return $result;
    }

    private function getRoleNameByTaskName(string $taskName): string
    {
        if (str_starts_with($taskName, '1. ')) return 'Промова';
        if (str_contains($taskName, 'Промова.')) {
            return 'Учнівська Промова';
        }
        return match (trim($taskName, '1234567890. ')) {
            'Місцеві потреби' => 'Старійшина',
            'Вивчення Біблії у зборі' => 'Вивченя Біблії',
            'Читання Біблії' => 'Читання Біблії',
            'Промова' => 'Учнівська Промова',
            'Починаємо розмову' => 'Школа',
            'Розвиваємо інтерес' => 'Школа',
            'Пояснюємо свої переконання' => 'Школа',
            'Підготовка учнів'  => 'Школа',
            default => 'Призначений брат'
        };
    }
}
