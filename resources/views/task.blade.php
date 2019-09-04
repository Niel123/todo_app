@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-1">
            
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Todos</div>
                <form id="form-todo" method="POST" action="{{ route('login.custom') }}">
                   {{ csrf_field() }}
                    <div class="card-body">
                        <input type="hidden" name="task_id" id="task_id_edit" >
                           <div class="form-group">
                            <input type="text" class="form-control " name="task_name" id="task_name" placeholder="Enter Task">
                            <div class="invalid-feedback" id="invalid-message">
                              Please enter task.
                            </div>
                          </div>
                          <div id="div-add">
                            <button id="btn-save" onclick="saveTask()" type="button" class="btn btn-primary"> Add Task <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                          </div>
                          <div id="div-edit" style="display: none;">
                            <button id="btn-edit" onclick="saveEditedTask()" type="button" class="btn btn-success"> Save Changes <i class="fa fa-save" aria-hidden="true"></i></button>
                            <button id="btn-save" onclick="clearFields()" type="button" class="btn btn-warning"> Cancel Edit <i class="fa fa-close" aria-hidden="true"></i></button>
                          </div>
                        <hr> 
                        <ul class="list-group" id="task-list">
                            @foreach(Auth::user()->tasks as $task)
                                <li class="list-group-item li{{$task->id}}">
                                    <label for="checkbox" class="label">
                                       {{$task->task_name}}
                                    </label>
                                    <div class="pull-right action-buttons">
                                        <a    task_id='{{ $task->id }}' task_name='{{ $task->task_name }}'  onclick="editTask(this)" title="Edit" href="javascript:;"><span class=""><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                                       <a style="color: red"  task_id='{{ $task->id }}'  onclick="deleteTask(this)" title="Delete" href="javascript:;"><span class=""><i class="fa fa-trash" aria-hidden="true"></i></span></a>
       
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                           
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
