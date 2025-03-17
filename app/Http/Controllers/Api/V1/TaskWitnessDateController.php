<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\TaskWitnessDateResource;
use App\Models\TaskWitnessDate;
use Illuminate\Http\Request;

class TaskWitnessDateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskWitnessDateResource::collection(TaskWitnessDate::paginate());
    }


    /**
     * Display the specified resource.
     */
    public function show(TaskWitnessDate $taskWitnessDate)
    {
        return new TaskWitnessDateResource($taskWitnessDate);
    }
}
