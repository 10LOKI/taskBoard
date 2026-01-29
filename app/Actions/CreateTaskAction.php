<?php

namespace App\Actions;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CreateTaskAction
{
    public function execute(array $data): Task
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'deadline' => $data['deadline'],
            'user_id' => Auth::id()
        ]);
    }
}