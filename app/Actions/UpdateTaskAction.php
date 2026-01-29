<?php

namespace App\Actions;

use App\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, array $data): Task
    {
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'deadline' => $data['deadline']
        ]);

        return $task->fresh();
    }
}