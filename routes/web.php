<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
  return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks' =>  \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('tasks/create','create')
->name('tasks.create');



Route::get('tasks/{id}',function($id) {
    return view('show',['task'=>\App\Models\Task::findOrFail($id)]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    dd($request->all());
})->name('tasks.store');


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

