<?php

namespace App\Http\Controllers;

use App\Models\TaskWitnessDate;
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


    public function create(int $year = 0, int $week = 0)
    {

        $date = $this->dateManager->getDate($year, $week);
        $year = $date->getFullYear();
        $week = $date->getWeek();

        return view('task.create', [
            'year' => $year,
            'week' => $week,
            'date' => $this->tasksManager->getDateString($year, $week),
            'tasks' => $this->tasksManager->getTasksData($date)
        ]);
    }

    public function store(int $year = 0, int $week = 0, Request $request)
    {
        //TODO add validation
        $date = $this->dateManager->getDate($year, $week);
        $year = $date->getFullYear();
        $week = $date->getWeek();
        $witnesses = $request->get('witnesses');

        $result = $this->tasksManager->createSchedule($witnesses, $date);

        $redirect = redirect()->route('task.create', ['year' => $year, 'week' => $week]);
        return $result ? $redirect->with('success', 'Scedule  was created!'): $redirect->with('error', 'Some error was hapenned!') ;
;    }
}
