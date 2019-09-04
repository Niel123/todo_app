@extends('layouts.app')

@section('title', 'Todo App')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>Welcome to Todo App.</p>
@endsection