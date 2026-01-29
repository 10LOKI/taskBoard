<?php

namespace App\Actions;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class BulkCreateTasksAction
{
    public function execute(array $tasksData): int
    {
        $createdCount = 0;
        
        foreach ($tasksData as $taskData) {
            if (!empty($taskData['title'])) {
                Task::create([
                    'title' => $taskData['title'],
                    'description' => $taskData['description'] ?? null,
                    'priority' => $taskData['priority'] ?? 'medium',
                    'status' => 'todo',
                    'deadline' => $taskData['deadline'] ?? null,
                    'user_id' => Auth::id()
                ]);
                $createdCount++;
            }
        }
        
        return $createdCount;
    }
}