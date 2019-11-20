@extends('layouts/app')
@section('content')
<h1>{{ $task->name }} </h1>
<p>{{ $task->text }}</p>
@endsection