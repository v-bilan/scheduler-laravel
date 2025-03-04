<?php

namespace App\Http\Controllers;

use App\Services\DateManager;
use App\Services\TaskManager;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private DateManager $dateManager,
        private TaskManager $tasksManager
    ) {

    }


    public function index(int $year = 0, int $week = 0)
    {

        $date = $this->dateManager->getDate($year, $week);
        $year = $date->getFullYear();
        $week = $date->getWeek();

        return view('task.index', [
            'year' => $date->getFullYear(),
            'week' => $date->getFullYear(),
            'date' => $this->tasksManager->getDateString($date->getFullYear(), $date->getWeek()),
            'tasks' => $this->tasksManager->getTasksData($date)
        ]);
    }
}
