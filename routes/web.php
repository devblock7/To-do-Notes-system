<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ToDoController::class, 'index'])->name('index');

// get todos list.
Route::get('/todos', [ToDoController::class, 'getToDos'])->name('get.todos'); 

// Create a task.
Route::post('/create', [ToDoController::class, 'createTask'])->name('create.task'); 

// Delete a task.
Route::get('/delete/{task_id}', [ToDoController::class, 'deleteTask'])->name('delete.task');

// Complete a task.
Route::get('/complete/{task_id}', [ToDoController::class, 'completeTask'])->name('complete.task');

// Edit a task.

Route::post('update', [ToDoController::class, 'updateTask'])->name('get.task'); 


