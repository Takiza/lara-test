<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(){
        return view('welcome');
    }
    
    
    public function tasks(){
        $tasks = \App\Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks'=>$tasks
            ]);
    }
    
    
    public function deny(){
        return redirect('/tasks');
    }
    
    
    public function addTask(){
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
        }
        
        
    public function show(\App\Task $task){
            return view('post', [
            'task'=>$task
            ]);
    }
    
    public function edit(\App\Task $task){
        $tasks = \App\Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks'=>$tasks,
            'edit'=>$task
            ]);
        }
    
    
    public function editConfirm($request){
        $validator = Validator::make($request->all(), [
        'name2'=>'required|max:255',
        'text2'=>'required|max:255'
        ]);
        
    if ($validator->fails()){
        return redirect('/tasks')
        ->withInput()
        ->withErrors($validator);
    }
    
    $tasks = \App\Task::orderBy('created_at', 'asc')->get();
    
    foreach ($tasks as $task){
        if ($task->id == $request->id){
            $task->name = $request->name2;
            $task->text = $request->text2;
            $task->save();
        }
    }
    
    return redirect('/tasks');
    }
    
    
    public function delete(\App\Task $task){
        $task->delete();
        return redirect('/tasks');
    }
}
