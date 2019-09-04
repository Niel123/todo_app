<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Todo App') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Todo App
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script type="text/javascript">
    let task_id = null;
    let uid = null;
    function saveTask()
    {
        
        $("#btn-save").attr('disabled', true);
        $("#btn-save").html('Saving Task <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        let task_name = $("#task_name").val();
        if (task_name=="") {
            $("#task_name").addClass("is-invalid");
        }else{
            $.ajax({
                url: 'saveTask',
                data: $("#form-todo").serialize(),
                type: 'POST',
                dataType : 'JSON',
                success: function(data) { console.log(data);
                    if (data.success==true) {
                        clearFields();
                        $("#task-list").prepend('<li class="list-group-item li'+ data.id +'"> <label for="checkbox" class="label"> ' + task_name  + ' </label> <div class="pull-right action-buttons"> <a   task_id="'+ data.id +'" task_name="' + task_name  + '"  onclick="editTask(this)" title="Edit" href="javascript:;"><span class=""><i class="fa fa-pencil" aria-hidden="true"></i></span></a> <a style="color: red" uid="" task_id="'+ data.id +'"  onclick="deleteTask(this)" title="Delete" href="javascript:;"><span class=""><i class="fa fa-trash" aria-hidden="true"></i></span></a> </div> </li>')
                        
                    }else{
                        alert('Somethin went wrong');
                    }
                },
                error : function(){
                    alert('Somethin went wrong');
                }
            });
        }
    }

    function editTask(el)
    {
        task_id = $(el).attr('task_id');
        $("#task_name").val($(el).attr('task_name'));
        $("#div-add").hide();
        $("#div-edit").show();
        $("#task_id_edit").val($(el).attr('task_id'));

    }

    function saveEditedTask()
    {  
        $("#btn-edit").attr('disabled', true);
        $("#btn-edit").html('Saving Task <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        let task_name = $("#task_name").val();
        if (task_name=="") {
            $("#task_name").addClass("is-invalid");
        }else{
            var data = $("#form-todo").serialize();
            $.ajax({
                url: 'editTask',
                data: data,
                type: 'POST',
                dataType : 'JSON',
                success: function(data) { console.log(data);
                    if (data.success==true) {
                        clearFields();
                        $(".li"+task_id).find('.label').html(task_name);
                        $("#btn-edit").attr('disabled', false);
                        $("#btn-edit").html('Save Changes <i class="fa fa-save" aria-hidden="true"></i>');
                    }else{
                        alert('Somethin went wrong');
                    }
                },
                error : function(){
                   alert('Somethin went wrong');
                }
            });
        }
       
    }

    function deleteTask(el)
    {  
       
       let task_id = $(el).attr('task_id');
       $(".li"+task_id).css({"background-color": "rgba(239, 0, 0, 0.53)", "color":"#fff"});
        $.ajax({
            url: 'deleteTask',
            data: { task_id : task_id },
            type: 'GET',
            dataType : 'JSON',
            success: function(data) { console.log(data);
                if (data.success==true) {
                    $(".li"+task_id).hide(100);
                    clearFields();
                }else{
                    alert('Somethin went wrong');
                }
            },
            error : function(){
               alert('Somethin went wrong');
            }
        });
       
    }

    function clearFields()
    {
        $("#task_name").removeClass("is-invalid");
        $("#task_name").val("");
         $("#div-add").show();
        $("#div-edit").hide();
        $("#btn-save").attr('disabled', false);
        $("#btn-save").html('Add Task <i class="fa fa-plus-circle" aria-hidden="true"></i>');
    }

    

    
</script>
</html>
