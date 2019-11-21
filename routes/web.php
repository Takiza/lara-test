<?php

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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
        
Route::get('/tasks', function () {
    $tasks = \App\Task::orderBy('created_at', 'asc')->get();
    return view('tasks', [
        'tasks'=>$tasks
        ]);
});

Route::get('/tasks/post/{task}', function () {
    return redirect('/tasks');
});


Route::post('/tasks/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name'=>'required|max:255',
        'text'=>'required|max:255'
        ]);
        
    if ($validator->fails()){
        return redirect('/tasks')
        ->withInput()
        ->withErrors($validator);
    }
    
    $task = new \App\Task;
    $task->name = $request->name;
    $task->text = $request->text;
    $task->save();
    
    return redirect('/tasks');
});

Route::post('/tasks/post/{task}', function (\App\Task $task) {
    
    return view('post', [
        'task'=>$task
        ]);
});


Route::delete('/tasks/task/{task}', function (\App\Task $task) {
    $task->delete();
    
    return redirect('/tasks');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
