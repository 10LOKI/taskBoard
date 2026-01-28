<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Debug: Check what priority values exist
        $priorities = Task::where('user_id', $userId)->distinct()->pluck('priority');
        dd($priorities); // This will show all priority values in your database
        
        $stats =
            [
                'total' => Task::where('user_id',$userId)->count(),
                'todo' => Task::where('user_id',$userId)->where('status','todo')->count(),
                'in_progress' => Task::where('user_id',$userId) -> where('status','in_progress') -> count(),
                'done' => Task::where('user_id',$userId) -> where('status','done') -> count(),
                'overdue' => Task::where('user_id', $userId) -> where('status','!=','done') -> where('deadline', '<', now()) -> count(),
            ];
        $recentTasks = Task::where('user_id',$userId) -> orderBy('created_at','desc') -> limit(5) -> get();
        $highPriorityTasks =
            [
                'total' => Task::where('user_id',$userId)->where('priority','high')->count(),
                'completed' => Task::where('user_id',$userId)->where('priority','high') -> where('status','done') -> count(),
                'pending' => Task::where('user_id',$userId) -> where('priority','high') -> where('status','!=','done') -> count(),
            ];
        $mediumPriorityTasks =
            [
                'total' => Task::where('user_id',$userId)->where('priority','medium')->count(),
                'completed' => Task::where('user_id',$userId)->where('priority','medium') -> where('status','done') -> count(),
                'pending' => Task::where('user_id',$userId) -> where('priority','medium') -> where('status','!=','done') -> count(),
            ];
        $lowPriorityTasks =
            [
                'total' => Task::where('user_id',$userId)->where('priority','low')->count(),
                'completed' => Task::where('user_id',$userId)->where('priority','low') -> where('status','done') -> count(),
                'pending' => Task::where('user_id',$userId) -> where('priority','low') -> where('status','!=','done') -> count(),
            ];
        return view('dashboard',compact('stats' , 'recentTasks','highPriorityTasks','mediumPriorityTasks','lowPriorityTasks'));
    }
}
