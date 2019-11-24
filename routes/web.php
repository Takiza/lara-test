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


Route::get('/', 'TasksController@index');
        
Route::get('/tasks', 'TasksController@tasks');//->middleware('verified');

Route::get('/tasks/post/{task}', 'TasksController@deny');

Route::post('/tasks/task', 'TasksController@addTask');

/*Route::post('/tasks/task', function(Request $request){
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
});*/

Route::post('/tasks/post/{task}', 'TasksController@show');

Route::post('/tasks/edit/{task}', 'TasksController@edit');

Route::post('/tasks/edit-confirm', 'TasksController@editConfirm');

Route::delete('/tasks/task/{task}', 'TasksController@delete');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
