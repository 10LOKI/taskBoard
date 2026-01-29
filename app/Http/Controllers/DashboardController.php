<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Create sample tasks if none exist
        if (Task::where('user_id', $userId)->count() == 0) {
            Task::create([
                'title' => 'Complete Project Documentation',
                'description' => 'Finish all technical documentation',
                'priority' => 'high',
                'status' => 'todo',
                'deadline' => now()->addDays(7),
                'user_id' => $userId
            ]);
            
            Task::create([
                'title' => 'Review Code Changes',
                'description' => 'Review pull requests from team',
                'priority' => 'medium',
                'status' => 'in_progress',
                'deadline' => now()->addDays(3),
                'user_id' => $userId
            ]);
            
            Task::create([
                'title' => 'Deploy to Production',
                'description' => 'Push version 2.1.0 to production',
                'priority' => 'high',
                'status' => 'done',
                'deadline' => now()->subDays(2),
                'user_id' => $userId
            ]);
            
            Task::create([
                'title' => 'Update Dependencies',
                'description' => 'Update all npm packages',
                'priority' => 'low',
                'status' => 'todo',
                'deadline' => now()->addDays(14),
                'user_id' => $userId
            ]);
            
            Task::create([
                'title' => 'Fix Bug Reports',
                'description' => 'Address critical bug reports',
                'priority' => 'high',
                'status' => 'in_progress',
                'deadline' => now()->addDays(1),
                'user_id' => $userId
            ]);
        }

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
        $toDoTasksByStatus = [
            'total' => Task::where('user_id',$userId)->where('status','todo')->count(),
            'high' => Task::where('user_id',$userId)->where('status','todo')->where('priority','high')->count(),
            'medium' => Task::where('user_id',$userId)->where('status','todo')->where('priority','medium')->count(),
            'low' => Task::where('user_id',$userId)->where('status','todo')->where('priority','low')->count(),
        ];

        $inProgressTasksByStatus = [
            'total' => Task::where('user_id',$userId)->where('status','in_progress')->count(),
            'high' => Task::where('user_id',$userId)->where('status','in_progress')->where('priority','high')->count(),
            'medium' => Task::where('user_id',$userId)->where('status','in_progress')->where('priority','medium')->count(),
            'low' => Task::where('user_id',$userId)->where('status','in_progress')->where('priority','low')->count(),
        ];

        $doneTasksByStatus = [
            'total' => Task::where('user_id',$userId)->where('status','done')->count(),
            'high' => Task::where('user_id',$userId)->where('status','done')->where('priority','high')->count(),
            'medium' => Task::where('user_id',$userId)->where('status','done')->where('priority','medium')->count(),
            'low' => Task::where('user_id',$userId)->where('status','done')->where('priority','low')->count(),
        ];

        return view('dashboard',compact('stats', 'recentTasks','highPriorityTasks','mediumPriorityTasks','lowPriorityTasks','toDoTasksByStatus','inProgressTasksByStatus','doneTasksByStatus'));
    }
}
