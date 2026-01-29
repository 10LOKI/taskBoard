<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id',Auth::id()) -> orderBy('created_at','desc') -> get();
        return view('tasks.index',compact('tasks'));
    }
}
