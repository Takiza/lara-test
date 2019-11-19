@extends('layouts/app')

@section('content')

<div class="card-body">
    @include('errors')
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{  csrf_field() }}
        
        <div class="row">
            <div class="form-group">
                
                <label for="Task" class="col-sm-3 control-label">Task</label>
                
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success">Add Task</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if(count($tasks) > 0)
<div class="row">
  
@foreach($tasks as $task)
    <div class="col-sm-3">
        <div class="card">
            <div class="card-heading">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    
                    <tbody>
                        <tr>
                        <td class="table-text">
                            <div>{{ $task->name }}</div>
                        </td>
                        <td>
                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection