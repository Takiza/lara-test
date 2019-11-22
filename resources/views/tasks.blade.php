@extends('layouts/app')

@section('content')

<div class="container">
    <div class="card-body">
        @include('errors')
        <form action="{{ url('tasks/task') }}" method="POST" class="form-horizontal">
            {{  csrf_field() }}
            
            <div class="row">
                <div class="form-group">
                    
                    <label for="Task" class="col-sm-3 control-label">Add Task</label>
                    
                    <div class="row">
                        <div class="col-sm-3 my-2">
                            <input type="text" name="name" id="task-name" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-6 my-2">
                            <input type="text" name="text" id="task-text" class="form-control" placeholder="Text">
                        </div>
                        <div class="col-sm-3 my-2">
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
            <div class="col-sm">
                <div class="card  my-3">
                    <div class="card-body">
                        
                        @if(!isset($edit) || $edit != $task)
                            <h5 class="card-title">{{ $task->name }}</h5>
                            
                            <p class="card-text">{{ mb_strimwidth($task->text, 0, 30, "...") }}</p>
                            
                            <div class="d-flex flex-row justify-content-between">
                                
                                <form class="block" action="{{ url('tasks/post/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-info">
                                        Read more
                                    </button>
                                </form>
                                
                                <form class="block" action="{{ url('tasks/edit/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning">
                                        Edit
                                    </button>
                                </form>
                                
                                <form class="block" action="{{ url('tasks/task/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                                
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            
                        @elseif($edit == $task)
                            
                            <form class="block" action="{{ url('tasks/edit-confirm/') }}" method="POST">
                                    {{ csrf_field() }}
                                <h5 class="card-title">
                                    <input type="text" name="name2" id="task-text" class="form-control" placeholder="Task name" value="{{ $task->name }}">
                                </h5>
                                
                                <p class="card-text">
                                    <input type="text" name="text2" id="task-text" class="form-control" placeholder="Task text" value="{{ $task->text }}" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                </p>
                                
                                <div class="d-flex flex-row justify-content-between">
                                    
                                    
                                        <button name="id" class="btn btn-success" value="{{ $task->id }}">
                                            Confirm
                                        </button>
                                    
                                    
                                    <form class="block" action="{{ url('tasks/')}}" method="GET">
                                        <button class="btn btn-danger">
                                            Cancel
                                        </button>
                               </form>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection