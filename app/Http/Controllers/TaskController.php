<?php

namespace App\Http\Controllers;

use App\Actions\CreateTaskAction;
use App\Actions\UpdateTaskAction;
use App\Actions\DeleteTaskAction;
use App\Actions\BulkCreateTasksAction;
use App\Actions\UpdateTaskAttributeAction;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::forUser()->orderBy('created_at', 'desc')->get();

        $totalTasks = $tasks->count();
        $pendingCount = Task::forUser()->pending()->count();
        $overdueCount = Task::forUser()->overdue()->count();

        return view('tasks.tasks', compact('tasks', 'totalTasks', 'pendingCount', 'overdueCount'));
    }
    
    public function store(Request $request, CreateTaskAction $createTaskAction)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date'
        ]);
        
        $createTaskAction->execute($validated);
        
        return response()->json(['message' => 'Task created successfully']);
    }
    
    public function update(Request $request, Task $task, UpdateTaskAction $updateTaskAction)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date'
        ]);
        
        $updateTaskAction->execute($task, $validated);

        return response()->json(['message' => 'Task updated successfully']);
    }
    
    public function destroy(Task $task, DeleteTaskAction $deleteTaskAction)
    {
        $deleteTaskAction->execute($task);
        return response()->json(['message' => 'Task deleted successfully']);
    }
    
    public function bulkCreate(Request $request, BulkCreateTasksAction $bulkCreateTasksAction)
    {
        $tasks = $request->input('tasks');
        $createdCount = $bulkCreateTasksAction->execute($tasks);
        
        return response()->json([
            'message' => "Successfully created {$createdCount} tasks"
        ]);
    }
    
    public function updateAttribute(Request $request, Task $task, UpdateTaskAttributeAction $updateTaskAttributeAction)
    {
        $field = $request->has('priority') ? 'priority' : 'status';
        $value = $request->input($field);
        
        $updateTaskAttributeAction->execute($task, $field, $value);
        
        return response()->json(['message'=> 'Task updated successfully']);
    }
}