<?php

namespace App\Actions;

use App\Models\Task;

class UpdateTaskAttributeAction
{
    public function execute(Task $task, string $field, string $value): Task
    {
        $task->update([$field => $value]);
        return $task->fresh();
    }
}