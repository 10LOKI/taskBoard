<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $totalTasks = $tasks->count();
        $pendingCount = $tasks->whereIn('status', ['todo', 'in_progress'])->count();
        $overdueCount = $tasks->where('status', '!=', 'done')->filter(function($task) {
            return $task->deadline && \Carbon\Carbon::parse($task->deadline)->isPast();
        })->count();

        return view('tasks.tasks', compact('tasks', 'totalTasks', 'pendingCount', 'overdueCount'));
    }

    public function edit($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'deadline' => $request->deadline,
        ]);

        return response()->json(['success' => true, 'message' => 'Task updated successfully']);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();

        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }
    public function archive($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete(); // Soft delete
        return response()->json(['success' => true, 'message' => 'Task archived successfully']);
    }

    public function archived()
    {
        $archivedTasks = Task::onlyTrashed()->where('user_id', Auth::id())->orderBy('deleted_at', 'desc')->get();
        return view('tasks.archived', compact('archivedTasks'));
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->restore();
        return response()->json(['success' => true, 'message' => 'Task restored successfully']);
    }

    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->forceDelete();
        return response()->json(['success' => true, 'message' => 'Task permanently deleted']);
    }
}
