<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        $totalTasks = $tasks->count();
        $pendingCount = $tasks->where('status', '!=', 'done')->count();
        $overdueCount = $tasks->where('status', '!=', 'done')
                            ->where('deadline', '<', now())
                            ->whereNotNull('deadline')
                            ->count();

        return view('tasks.tasks', compact('tasks', 'totalTasks', 'pendingCount', 'overdueCount'));
    }
    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date'
        ]);
        Task::create([
            'title' => $request -> title,
            'description' => $request -> description,
            'priority' => $request -> priority,
            'status' => $request -> status,
            'deadline' => $request -> deadline,
            'user_id' => Auth::id()
        ]);
        return response() -> json(['message' => 'Task created in succes']);
    }
    public function update(Request $request , Task $task)
    {
        $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date'
        ]);
        $task->update($request->only(['title', 'description', 'priority', 'status', 'deadline']));

        return response()->json(['message' => 'Task updated successfully']);
    }
    public function destroy(Task $task)
    {
        $task -> delete();
        return response() -> json(['message ' => 'Task deleted ']);
    }
    public function bulkCreate(Request $request)
    {
        $tasks = $request -> input('tasks');
        foreach ($tasks as $taskData)
        {
            if(!empty($taskData['title']))
            {
                Task:create([
                    'title' => $taskData['title'],
                    'description' => $taskData['description'] ?? null,
                    'priority' => $taskData['priority'] ?? 'medium',
                    'status' => 'todo',
                    'deadline' => $taskData['deadline'] ?? null,
                    'user_id' => Auth::id()
            ]);
            }
        }
        return response() -> json(['message' => 'Tasks created succesfully']);
    }
    public function updateAttribute(Request $request , Task $task)
    {
        $field = $request -> has('priority') ? 'priority' : 'status';
        $value = $request -> input($field);
        $task -> update([$field => $value]);
        return response() -> json(['message'=> 'Task updated succesful']);
    }
}
