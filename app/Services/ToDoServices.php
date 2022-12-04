<?php

namespace App\Services;


use App\Models\ToDo;

class ToDoServices
{


    /**
     * Create the specified task in database.
     * 
     * @param object $request
     * @return void
     */
    public function createNewTask($request)
    {


        $todo = new ToDo;

        $todo->description = $request->description;

        $todo->completed = false;

        $todo->save();
    }

    /**
     * Delete the specified task from database.
     * 
     * @param  int  $taskId
     * @return void
     */
    public function deleteTask($taskId)
    {

        $todo = ToDo::find($taskId);

        $todo->delete();
    }

    /**
     * Mark the specified task in database as completed.
     * 
     * @param  int  $taskId
     * @return void
     */
    public function completeTask($taskId)
    {

        $todo = ToDo::find($taskId);

        $todo->completed = true;

        $todo->update();
    }

    /**
     * Update the specified task description in database.
     * 
     * @param object $request
     * @return void
     */
    public function updateTask($request)
    {

        $todotask = ToDo::find($request->id);

        $todotask->update(['description' => $request->description]);
    }
}
