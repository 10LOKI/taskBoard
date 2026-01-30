<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100">
                📊 Task Manager Dashboard
            </h2>
            <div class="text-gray-600 dark:text-gray-400 text-sm font-mono">
                {{ now()->format('l, M d, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- ======================== STATISTICS SECTION ======================== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-4">
                <!-- Total Tasks Card -->
                <div class="stat-card stat-card--blue">
                    <div class="stat-card__icon stat-card__icon--blue">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V3z"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">Total Tasks</p>
                        <p class="stat-card__value">{{ $stats['total'] }}</p>
                        <p class="stat-card__description">All your tasks</p>
                    </div>
                </div>

                <!-- To Do Card -->
                <div class="stat-card stat-card--orange">
                    <div class="stat-card__icon stat-card__icon--orange">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">To Do</p>
                        <p class="stat-card__value">{{ $stats['todo'] }}</p>
                        <p class="stat-card__description">Pending</p>
                    </div>
                </div>

                <!-- In Progress Card -->
                <div class="stat-card stat-card--yellow">
                    <div class="stat-card__icon stat-card__icon--yellow">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-2a4 4 0 00-8 0v2h8z"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">In Progress</p>
                        <p class="stat-card__value">{{ $stats['in_progress'] }}</p>
                        <p class="stat-card__description">In progress</p>
                    </div>
                </div>

                <!-- Done Card -->
                <div class="stat-card stat-card--green">
                    <div class="stat-card__icon stat-card__icon--green">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">Done</p>
                        <p class="stat-card__value">{{ $stats['done'] }}</p>
                        <p class="stat-card__description">Completed</p>
                    </div>
                </div>

                <!-- Overdue Card -->
                <div class="stat-card stat-card--red">
                    <div class="stat-card__icon stat-card__icon--red">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">Overdue</p>
                        <p class="stat-card__value">{{ $stats['overdue'] }}</p>
                        <p class="stat-card__description">Past deadline</p>
                    </div>
                </div>

                <!-- Completion Rate Card -->
                <div class="stat-card stat-card--purple">
                    <div class="stat-card__icon stat-card__icon--purple">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M1 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h16a1 1 0 011 1v6a1 1 0 01-1 1H2a1 1 0 01-1-1v-6zm0 8a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H2a1 1 0 01-1-1v-2z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">Completion</p>
                        <p class="stat-card__value">{{ $stats['total'] > 0 ? round(($stats['done'] / $stats['total']) * 100) : 0 }}%</p>
                        <p class="stat-card__description">Progress rate</p>
                    </div>
                </div>

                <!-- Archived Card -->
                <div class="stat-card stat-card--gray">
                    <div class="stat-card__icon stat-card__icon--gray">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <div class="stat-card__content">
                        <p class="stat-card__label">Archived</p>
                        <p class="stat-card__value">{{ $stats['archived'] }}</p>
                        <p class="stat-card__description">Soft deleted</p>
                    </div>
                </div>
            </div>

            <!-- ======================== THREE TABLES SECTION ======================== -->

            <!-- TABLE 1: RECENT TASKS -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-header__title">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">📋 Recent Tasks</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Your active and upcoming tasks</p>
                    </div>
                    <a href="{{route('tasks.index')}}" class="btn btn--secondary btn--sm">View all →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="task-table">
                        <thead>
                        <tr class="table-header-row">
                            <th class="table-cell table-cell--header">Task Title</th>
                            <th class="table-cell table-cell--header">Description</th>
                            <th class="table-cell table-cell--header">Priority</th>
                            <th class="table-cell table-cell--header">Status</th>
                            <th class="table-cell table-cell--header">Deadline</th>
                            <th class="table-cell table-cell--header">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tbody>
                        @forelse($recentTasks as $task)
                            <tr class="table-body-row {{ $task->status == 'done' ? 'table-body-row--completed' : '' }}">
                                <td class="table-cell font-semibold {{ $task->status == 'done' ? 'line-through text-gray-500 dark:text-gray-400' : '' }}">
                                    {{ $task->title }}
                                </td>
                                <td class="table-cell text-sm">{{ $task->description }}</td>
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
                                <td class="table-cell text-sm">{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('M d') : 'No deadline' }}</td>
                                <td class="table-cell">
                                    <div class="action-buttons">
                                        <button class="action-btn action-btn--edit" onclick="editTask({{ $task->id }})" title="Edit">✎</button>
                                        <button class="action-btn action-btn--delete" onclick="deleteTask({{ $task->id }})" title="Delete">✕</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-cell text-center text-gray-500">No tasks found</td>
                            </tr>
                        @endforelse
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABLE 2: TASKS BY PRIORITY -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-header__title">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">⚡ Tasks by Priority</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Organized by importance level</p>
                    </div>
                    <a href="{{route('tasks.index')}}" class="btn btn--secondary btn--sm">Manage →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="task-table">
                        <thead>
                        <tr class="table-header-row">
                            <th class="table-cell table-cell--header">Priority</th>
                            <th class="table-cell table-cell--header">Count</th>
                            <th class="table-cell table-cell--header">Completed</th>
                            <th class="table-cell table-cell--header">Pending</th>
                            <th class="table-cell table-cell--header">Progress</th>
                            <th class="table-cell table-cell--header">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-body-row">
                            <td class="table-cell"><span class="badge badge--high">High Priority</span></td>
                            <td class="table-cell font-bold text-lg">{{ $highPriorityTasks['total'] }}</td>
                            <td class="table-cell text-green-600 dark:text-green-400 font-semibold">{{ $highPriorityTasks['completed'] }}</td>
                            <td class="table-cell text-orange-600 dark:text-orange-400 font-semibold">{{ $highPriorityTasks['pending'] }}</td>
                            <td class="table-cell">
                                <div class="progress-bar">
                                    <div class="progress-bar__fill" style="width: {{ $highPriorityTasks['total'] > 0 ? round(($highPriorityTasks['completed'] / $highPriorityTasks['total']) * 100) : 0 }}%"></div>
                                </div>
                            </td>
                            <td class="table-cell">
                                <a href="{{ route('tasks.index') }}" class="btn btn--primary btn--xs">View</a>
                            </td>
                        </tr>
                        <tr class="table-body-row">
                            <td class="table-cell"><span class="badge badge--medium">Medium Priority</span></td>
                            <td class="table-cell font-bold text-lg">{{ $mediumPriorityTasks['total'] }}</td>
                            <td class="table-cell text-green-600 dark:text-green-400 font-semibold">{{ $mediumPriorityTasks['completed'] }}</td>
                            <td class="table-cell text-orange-600 dark:text-orange-400 font-semibold">{{ $mediumPriorityTasks['pending'] }}</td>
                            <td class="table-cell">
                                <div class="progress-bar">
                                    <div class="progress-bar__fill" style="width: {{ $mediumPriorityTasks['total'] > 0 ? round(($mediumPriorityTasks['completed'] / $mediumPriorityTasks['total']) * 100) : 0 }}%"></div>
                                </div>
                            </td>
                            <td class="table-cell">
                                <a href="{{ route('tasks.index') }}" class="btn btn--primary btn--xs">View</a>
                            </td>
                        </tr>
                        <tr class="table-body-row">
                            <td class="table-cell"><span class="badge badge--low">Low Priority</span></td>
                            <td class="table-cell font-bold text-lg">{{ $lowPriorityTasks['total'] }}</td>
                            <td class="table-cell text-green-600 dark:text-green-400 font-semibold">{{ $lowPriorityTasks['completed'] }}</td>
                            <td class="table-cell text-orange-600 dark:text-orange-400 font-semibold">{{ $lowPriorityTasks['pending'] }}</td>
                            <td class="table-cell">
                                <div class="progress-bar">
                                    <div class="progress-bar__fill" style="width: {{ $lowPriorityTasks['total'] > 0 ? round(($lowPriorityTasks['completed'] / $lowPriorityTasks['total']) * 100) : 0 }}%"></div>
                                </div>
                            </td>
                            <td class="table-cell">
                                <a href="{{ route('tasks.index') }}" class="btn btn--primary btn--xs">View</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABLE 3: TASKS BY STATUS -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-header__title">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">🎯 Tasks by Status</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Categorized by current state</p>
                    </div>
                    <a href="{{route('tasks.index')}}" class="btn btn--secondary btn--sm">Details →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="task-table">
                        <thead>
                        <tr class="table-header-row">
                            <th class="table-cell table-cell--header">Status</th>
                            <th class="table-cell table-cell--header">Total</th>
                            <th class="table-cell table-cell--header">High</th>
                            <th class="table-cell table-cell--header">Medium</th>
                            <th class="table-cell table-cell--header">Low</th>
                            <th class="table-cell table-cell--header">Percentage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-body-row">
                            <td class="table-cell"><span class="badge badge--info">To Do</span></td>
                            <td class="table-cell font-bold text-lg">8</td>
                            <td class="table-cell"><span class="pill pill--high">2</span></td>
                            <td class="table-cell"><span class="pill pill--medium">4</span></td>
                            <td class="table-cell"><span class="pill pill--low">2</span></td>
                            <td class="table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold">33%</span>
                                    <div class="w-16 h-2 bg-blue-200 dark:bg-blue-900 rounded-full overflow-hidden">
                                        <div class="h-full bg-blue-500" style="width: 33%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-body-row">
                            <td class="table-cell"><span class="badge badge--warning">In Progress</span></td>
                            <td class="table-cell font-bold text-lg">6</td>
                            <td class="table-cell"><span class="pill pill--high">3</span></td>
                            <td class="table-cell"><span class="pill pill--medium">2</span></td>
                            <td class="table-cell"><span class="pill pill--low">1</span></td>
                            <td class="table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold">25%</span>
                                    <div class="w-16 h-2 bg-yellow-200 dark:bg-yellow-900 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-500" style="width: 25%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-body-row">
                            <td class="table-cell"><span class="badge badge--success">Done</span></td>
                            <td class="table-cell font-bold text-lg">10</td>
                            <td class="table-cell"><span class="pill pill--high">3</span></td>
                            <td class="table-cell"><span class="pill pill--medium">4</span></td>
                            <td class="table-cell"><span class="pill pill--low">3</span></td>
                            <td class="table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold">42%</span>
                                    <div class="w-16 h-2 bg-green-200 dark:bg-green-900 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-500" style="width: 42%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Task Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-96">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Edit Task</h3>
            <form id="editForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" id="editTitle" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea id="editDescription" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
                    <select id="editPriority" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select id="editStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="todo">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deadline</label>
                    <input type="date" id="editDeadline" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentTaskId = null;

        function editTask(taskId) {
            currentTaskId = taskId;
            fetch(`/tasks/${taskId}/edit`)
                .then(response => response.json())
                .then(task => {
                    document.getElementById('editTitle').value = task.title;
                    document.getElementById('editDescription').value = task.description;
                    document.getElementById('editPriority').value = task.priority;
                    document.getElementById('editStatus').value = task.status;
                    document.getElementById('editDeadline').value = task.deadline ? task.deadline.split(' ')[0] : '';
                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('editModal').classList.add('flex');
                });
        }

        function deleteTask(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`/tasks/${taskId}`, {
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

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                title: document.getElementById('editTitle').value,
                description: document.getElementById('editDescription').value,
                priority: document.getElementById('editPriority').value,
                status: document.getElementById('editStatus').value,
                deadline: document.getElementById('editDeadline').value
            };

            fetch(`/tasks/${currentTaskId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    location.reload();
                }
            });
        });
    </script>
</x-app-layout>
