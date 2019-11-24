@extends('layouts/app')
@section('content')
<div class="container">
    <h1>{{ $task->name }} </h1>
    <p>{{ $task->text }}</p>
    <form class="block" action="{{ url('tasks/') }}" method="GET">
        
        <button class="btn btn-info">
            Back
        </button>
    </form>
</div>
@endsection