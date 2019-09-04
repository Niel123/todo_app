<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $user = Auth::user();
        //$tasks = Tasks::orderBy('id','DESC')->get();
        $tasks = Task::all();
        return view('task', compact('tasks'));
    }

    public function saveTask(Request $request)
    {
       $request->validate([
           'task_name'=>'required',
        ]);
        $user_id = Auth::user()->id;
        $task = new Task;  
        $task->user_id = $user_id;
        $task->task_name = $request->task_name;
        $task->save();
        echo json_encode( array ('success' => true , 'id' => $task->id  ) );
    }

    public function editTask(Request $request)
    {
        $task = Task::find($request->task_id);  
        $task->task_name = $request->task_name;
        $task->save();
        echo json_encode( array ('success' => true   ) );
    }

    public function deleteTask(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->delete();
        echo json_encode( array ('success' => true   ) );
    }
    
}
