<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100">
                📦 Archived Tasks
            </h2>
            <a href="{{ route('tasks.index') }}" class="btn btn--secondary">
                ← Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="table-container">
                <div class="table-header">
                    <div class="table-header__title">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">📦 Archived Tasks</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tasks that have been archived</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="task-table">
                        <thead>
                        <tr class="table-header-row">
                            <th class="table-cell table-cell--header">Task Title</th>
                            <th class="table-cell table-cell--header">Description</th>
                            <th class="table-cell table-cell--header">Priority</th>
                            <th class="table-cell table-cell--header">Status</th>
                            <th class="table-cell table-cell--header">Archived Date</th>
                            <th class="table-cell table-cell--header">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($archivedTasks as $task)
                            <tr class="table-body-row">
                                <td class="table-cell font-semibold text-gray-500 dark:text-gray-400">
                                    {{ $task->title }}
                                </td>
                                <td class="table-cell text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($task->description, 50) }}</td>
                                <td class="table-cell">
                                    <span class="badge badge--{{ $task->priority == 'high' ? 'high' : ($task->priority == 'medium' ? 'medium' : 'low') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <td class="table-cell">
                                    <span class="badge badge--{{ $task->status == 'done' ? 'success' : ($task->status == 'in_progress' ? 'warning' : 'info') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td class="table-cell text-sm text-gray-500 dark:text-gray-400">
                                    {{ $task->deleted_at->format('M d, Y') }}
                                </td>
                                <td class="table-cell">
                                    <div class="flex gap-2">
                                        <button onclick="restoreTask({{ $task->id }})" class="action-btn action-btn--success" title="Restore">↩️</button>
                                        <button onclick="permanentDelete({{ $task->id }})" class="action-btn action-btn--delete" title="Delete Forever">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-cell text-center text-gray-500 py-8">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="text-3xl">📭</span>
                                        <p>No archived tasks found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function restoreTask(taskId) {
            if (confirm('Are you sure you want to restore this task?')) {
                fetch(`/tasks/${taskId}/restore`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }

        function permanentDelete(taskId) {
            if (confirm('Are you sure you want to permanently delete this task? This cannot be undone.')) {
                fetch(`/tasks/${taskId}/force-delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</x-app-layout>