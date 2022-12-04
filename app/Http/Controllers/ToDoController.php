<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ToDoServices;
use App\Models\ToDo;

class ToDoController extends Controller
{

    /**
     * Render front-end.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('app');
    }



    /**
     * Get list of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToDos()
    {
        $todos = ToDo::all();

        return $todos;
    }


    /**
     * Create new task.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function createTask(request $request)
    {

        $toDoService = new ToDoServices;

        $toDoService->createNewTask($request);
    }



    /**
     * Delete a task. 
     * 
     * @param int $taskId
     * @return void
     */
    public function deleteTask($taskId)
    {

        $toDoService = new ToDoServices;

        $toDoService->deleteTask($taskId);
    }


    /**
     * Complete a task. 
     * 
     * @param int $taskId
     * @return void
     */
    public function completeTask($taskId)
    {

        $toDoService = new ToDoServices;

        $toDoService->completeTask($taskId);
    }

    /**
     * Update the selected task.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function updateTask(request $request)
    {
        $toDoService = new ToDoServices;

        $toDoService->updateTask($request);
    }
}
