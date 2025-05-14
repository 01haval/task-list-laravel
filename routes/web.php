<?php

use Illuminate\Http\Response;
use \App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
  return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks' =>  Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('tasks/create','create')
->name('tasks.create');

Route::get('tasks/{id}/edit',function($id) {
    return view('edit',['task'=>Task::findOrFail($id)]);
})->name('tasks.show');

Route::get('tasks/{id}',function($id) {
    return view('show',['task'=>Task::findOrFail($id)]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    return redirect()->route('tasks.show',['id'=> $task->id])
    ->with('success','Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{id}', function ($id,Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    return redirect()->route('tasks.show',['id'=> $task->id])
    ->with('success','Task updated successfully!');
})->name('tasks.update');



// Route::get('/haval', function () {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo',function(){
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . ' !!!';
// });

//** this fallback route will appeare if the user write any route that does not exist in our Routes */
Route::fallback(function(){
    return 'still got somewhere !';
});


// GET to read data .
// POST to store new data and send forms .
// PUT to modify an existing thing.
// DELETE thats delete the data .

