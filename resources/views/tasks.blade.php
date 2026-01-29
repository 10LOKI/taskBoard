<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100">
                📝 Task Management
            </h2>
            <div class="text-gray-600 dark:text-gray-400 text-sm font-mono">
                {{ now()->format('l, M d, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- ======================== ACTION BUTTONS & SEARCH ======================== -->
            <div class="space-y-4">
                <!-- Button Row -->
                <div class="flex flex-wrap gap-3 items-center justify-between">
                    <div class="flex gap-2">
                        <button id="createTaskBtn" class="btn btn--primary">
                            ➕ Create Single Task
                        </button>
                        <button id="createMultipleBtn" class="btn btn--secondary">
                            ⚡ Create Multiple Tasks
                        </button>
                    </div>

                    <!-- Quick Stats -->
                    <div class="flex gap-4 text-sm text-gray-600 dark:text-gray-400">
                        <span><strong>Total:</strong> {{ $totalTasks }}</span>
                        <span><strong>Pending:</strong> {{ $pendingCount }}</span>
                        <span><strong>Overdue:</strong> {{ $overdueCount }}</span>
                    </div>
                </div>

                <!-- Search & Filters Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <!-- Search Input -->
                    <div>
                        <input type="text" id="searchInput" placeholder="🔍 Search by title or description..."
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Priority Filter -->
                    <div>
                        <select id="priorityFilter"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Priorities</option>
                            <option value="high">🔴 High</option>
                            <option value="medium">🟡 Medium</option>
                            <option value="low">🟢 Low</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <select id="statusFilter"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Status</option>
                            <option value="todo">📋 To Do</option>
                            <option value="in_progress">⏳ In Progress</option>
                            <option value="done">✅ Done</option>
                        </select>
                    </div>

                    <!-- Sort Deadline -->
                    <div>
                        <select id="sortDeadline"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sort by...</option>
                            <option value="asc">📅 Deadline: Earliest First</option>
                            <option value="desc">📅 Deadline: Latest First</option>
                            <option value="priority">⚡ By Priority</option>
                        </select>
                    </div>
                </div>

                <!-- Clear Filters -->
                <div>
                    <button id="clearFilters" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        ✖️ Clear all filters
                    </button>
                </div>
            </div>

            <!-- ======================== TASKS TABLE ======================== -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-header__title">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">📊 All Tasks</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage and track your tasks</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="task-table" id="tasksTable">
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
                        <tbody id="tasksBody">
                        @forelse($tasks as $task)
                            <tr class="table-body-row task-row {{ $task->status == 'done' ? 'table-body-row--completed' : '' }}" data-id="{{ $task->id }}" data-priority="{{ $task->priority }}" data-status="{{ $task->status }}" data-deadline="{{ $task->deadline }}">
                                <td class="table-cell font-semibold {{ $task->status == 'done' ? 'line-through text-gray-500 dark:text-gray-400' : '' }}">
                                    {{ $task->title }}
                                </td>
                                <td class="table-cell text-sm">{{ Str::limit($task->description, 50) }}</td>
                                <td class="table-cell">
                                    <select class="priority-select px-2 py-1 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" data-task-id="{{ $task->id }}">
                                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>🔴 High</option>
                                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>🟢 Low</option>
                                    </select>
                                </td>
                                <td class="table-cell">
                                    <select class="status-select px-2 py-1 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" data-task-id="{{ $task->id }}">
                                        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>📋 To Do</option>
                                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>⏳ In Progress</option>
                                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>✅ Done</option>
                                    </select>
                                </td>
                                <td class="table-cell text-sm">
                                    <span class="inline-block px-3 py-1 rounded-full {{ \Carbon\Carbon::parse($task->deadline)->isPast() && $task->status != 'done' ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('M d, Y') : '—' }}
                                    </span>
                                </td>
                                <td class="table-cell">
                                    <div class="flex gap-2">
                                        <button class="edit-btn action-btn action-btn--edit" data-id="{{ $task->id }}" title="Edit">✎</button>
                                        <button class="delete-btn action-btn action-btn--delete" data-id="{{ $task->id }}" title="Delete">✕</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-cell text-center text-gray-500 py-8">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="text-3xl">📭</span>
                                        <p>No tasks found. Create one to get started!</p>
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

    <!-- ======================== CREATE/EDIT MODAL ======================== -->
    <div id="taskModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-900 dark:text-white">Create Task</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    ✕
                </button>
            </div>

            <!-- Modal Content -->
            <form id="taskForm" class="p-6 space-y-4">
                @csrf
                <input type="hidden" id="taskId" name="task_id">
                <input type="hidden" id="methodInput" name="_method" value="POST">

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Task Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Enter task title">
                    <span class="error-text text-red-500 text-sm hidden"></span>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description <span class="text-gray-500">(optional)</span>
                    </label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Add task description..."></textarea>
                </div>

                <!-- Two Columns -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Deadline <span class="text-gray-500">(optional)</span>
                        </label>
                        <input type="date" id="deadline" name="deadline"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <select id="priority" name="priority" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select priority</option>
                            <option value="low">🟢 Low</option>
                            <option value="medium">🟡 Medium</option>
                            <option value="high">🔴 High</option>
                        </select>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select status</option>
                        <option value="todo">📋 To Do</option>
                        <option value="in_progress">⏳ In Progress</option>
                        <option value="done">✅ Done</option>
                    </select>
                </div>

                <!-- Modal Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="btn btn--primary flex-1">
                        <span id="submitBtnText">Create Task</span>
                    </button>
                    <button type="button" id="cancelBtn" class="btn btn--secondary flex-1">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================== CREATE MULTIPLE MODAL ======================== -->
    <div id="multipleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Create Multiple Tasks</h3>
                <button id="closeMultipleModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    ✕
                </button>
            </div>

            <!-- Modal Content -->
            <form id="multipleTasksForm" class="p-6 space-y-4">
                @csrf

                <div id="tasksContainer" class="space-y-4">
                    <!-- Task Field Template (will be cloned) -->
                    <div class="task-field-group p-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-semibold text-sm text-gray-900 dark:text-white">Task 1</h4>
                            <button type="button" class="remove-field text-red-600 hover:text-red-800 hidden">
                                Remove
                            </button>
                        </div>

                        <div class="space-y-3">
                            <!-- Title -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="tasks[0][title]" required
                                       class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Task title">
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Description
                                </label>
                                <textarea name="tasks[0][description]" rows="2"
                                          class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Task description..."></textarea>
                            </div>

                            <!-- Priority & Deadline -->
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Priority
                                    </label>
                                    <select name="tasks[0][priority]"
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="low">Low</option>
                                        <option value="medium" selected>Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Deadline
                                    </label>
                                    <input type="date" name="tasks[0][deadline]"
                                           class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add More Button -->
                <button type="button" id="addTaskFieldBtn" class="btn btn--secondary w-full">
                    ➕ Add Another Task
                </button>

                <p class="text-xs text-gray-600 dark:text-gray-400">
                    ℹ️ You can add up to 5 tasks at once
                </p>

                <!-- Modal Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="btn btn--primary flex-1">
                        ✅ Create All Tasks
                    </button>
                    <button type="button" id="cancelMultipleBtn" class="btn btn--secondary flex-1">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================== DELETE CONFIRMATION MODAL ======================== -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-sm w-full">
            <div class="p-6 space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete Task?</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Are you sure you want to delete this task? This action cannot be undone.
                </p>
                <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button id="confirmDeleteBtn" class="btn btn--danger flex-1">
                        Delete
                    </button>
                    <button id="cancelDeleteBtn" class="btn btn--secondary flex-1">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================== STYLES ======================== -->
    <style>
        .table-container {
            @apply bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden;
        }

        .table-header {
            @apply flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700;
        }

        .table-header__title {
            @apply flex-1;
        }

        .task-table {
            @apply w-full border-collapse;
        }

        .table-header-row {
            @apply bg-gray-100 dark:bg-gray-700;
        }

        .table-cell {
            @apply px-6 py-4 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700;
        }

        .table-cell--header {
            @apply font-semibold text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700;
        }

        .table-body-row {
            @apply hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors;
        }

        .table-body-row--completed {
            @apply bg-gray-50 dark:bg-gray-900;
        }

        .action-btn {
            @apply px-3 py-1 rounded font-semibold transition-colors;
        }

        .action-btn--edit {
            @apply bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800;
        }

        .action-btn--delete {
            @apply bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-800;
        }

        .btn {
            @apply px-4 py-2 rounded-lg font-medium transition-colors focus:outline-none;
        }

        .btn--primary {
            @apply bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600;
        }

        .btn--secondary {
            @apply bg-gray-200 text-gray-900 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600;
        }

        .btn--danger {
            @apply bg-red-600 text-white hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600;
        }

        .btn--sm {
            @apply px-3 py-1 text-sm;
        }

        .btn--xs {
            @apply px-2 py-1 text-xs;
        }

        .badge {
            @apply px-3 py-1 rounded-full text-sm font-medium;
        }

        .badge--high {
            @apply bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200;
        }

        .badge--medium {
            @apply bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200;
        }

        .badge--low {
            @apply bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200;
        }

        .badge--info {
            @apply bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200;
        }

        .badge--warning {
            @apply bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200;
        }

        .badge--success {
            @apply bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200;
        }
    </style>

    <!-- ======================== JAVASCRIPT ======================== -->
    <script>
        // ==================== STATE ====================
        let allTasks = @json($tasks);
        let currentTaskId = null;

        // ==================== DOM ELEMENTS ====================
        const taskModal = document.getElementById('taskModal');
        const multipleModal = document.getElementById('multipleModal');
        const deleteModal = document.getElementById('deleteModal');
        const taskForm = document.getElementById('taskForm');
        const multipleTasksForm = document.getElementById('multipleTasksForm');
        const searchInput = document.getElementById('searchInput');
        const priorityFilter = document.getElementById('priorityFilter');
        const statusFilter = document.getElementById('statusFilter');
        const sortDeadline = document.getElementById('sortDeadline');
        const tasksContainer = document.getElementById('tasksContainer');
        const tasksTable = document.getElementById('tasksTable');

        // ==================== MODAL CONTROLS ====================
        document.getElementById('createTaskBtn').addEventListener('click', () => openTaskModal());
        document.getElementById('createMultipleBtn').addEventListener('click', () => openMultipleModal());
        document.getElementById('closeModal').addEventListener('click', closeTaskModal);
        document.getElementById('closeMultipleModal').addEventListener('click', closeMultipleModal);
        document.getElementById('cancelBtn').addEventListener('click', closeTaskModal);
        document.getElementById('cancelMultipleBtn').addEventListener('click', closeMultipleModal);
        document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);

        function openTaskModal(taskId = null) {
            currentTaskId = taskId;

            if (taskId) {
                // Edit mode
                const task = allTasks.find(t => t.id == taskId);
                document.getElementById('modalTitle').textContent = '✏️ Edit Task';
                document.getElementById('submitBtnText').textContent = 'Update Task';
                document.getElementById('taskId').value = taskId;
                document.getElementById('methodInput').value = 'PUT';
                document.getElementById('title').value = task.title;
                document.getElementById('description').value = task.description || '';
                document.getElementById('deadline').value = task.deadline || '';
                document.getElementById('priority').value = task.priority;
                document.getElementById('status').value = task.status;
            } else {
                // Create mode
                document.getElementById('modalTitle').textContent = '➕ Create Task';
                document.getElementById('submitBtnText').textContent = 'Create Task';
                taskForm.reset();
                document.getElementById('taskId').value = '';
                document.getElementById('methodInput').value = 'POST';
            }

            taskModal.classList.remove('hidden');
        }

        function closeTaskModal() {
            taskModal.classList.add('hidden');
            taskForm.reset();
            currentTaskId = null;
        }

        function openMultipleModal() {
            multipleModal.classList.remove('hidden');
        }

        function closeMultipleModal() {
            multipleModal.classList.add('hidden');
            multipleTasksForm.reset();
            resetTaskFields();
        }

        // ==================== FORM SUBMISSIONS ====================
        taskForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(taskForm);
            const url = currentTaskId
                ? `/tasks/${currentTaskId}`
                : '/tasks';
            const method = currentTaskId ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                    },
                    body: formData
                });

                if (response.ok) {
                    const data = await response.json();
                    showNotification(data.message || 'Task saved successfully!', 'success');
                    closeTaskModal();
                    location.reload(); // Reload to update the task list
                } else {
                    const error = await response.json();
                    showNotification(error.message || 'Error saving task', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('An error occurred', 'error');
            }
        });

        multipleTasksForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(multipleTasksForm);

            try {
                const response = await fetch('/tasks/bulk-create', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                    },
                    body: formData
                });

                if (response.ok) {
                    const data = await response.json();
                    showNotification(data.message || 'Tasks created successfully!', 'success');
                    closeMultipleModal();
                    location.reload();
                } else {
                    const error = await response.json();
                    showNotification(error.message || 'Error creating tasks', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('An error occurred', 'error');
            }
        });

        // ==================== MULTIPLE TASKS DYNAMICS ====================
        let taskFieldCount = 1;

        document.getElementById('addTaskFieldBtn').addEventListener('click', (e) => {
            e.preventDefault();

            if (taskFieldCount >= 5) {
                showNotification('Maximum 5 tasks allowed', 'warning');
                return;
            }

            taskFieldCount++;

            const template = document.querySelector('.task-field-group');
            const newField = template.cloneNode(true);

            // Update indices
            newField.innerHTML = newField.innerHTML
                .replace(/tasks\[0\]/g, `tasks[${taskFieldCount - 1}]`)
                .replace(/Task 1/, `Task ${taskFieldCount}`);

            // Show remove button
            newField.querySelector('.remove-field').classList.remove('hidden');

            tasksContainer.appendChild(newField);

            // Attach remove listener
            newField.querySelector('.remove-field').addEventListener('click', (e) => {
                e.preventDefault();
                newField.remove();
                taskFieldCount--;
            });
        });

        // ==================== FILTERING & SEARCHING ====================
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const priorityVal = priorityFilter.value;
            const statusVal = statusFilter.value;
            const sortVal = sortDeadline.value;

            let filteredTasks = allTasks.filter(task => {
                const titleMatch = task.title.toLowerCase().includes(searchTerm);
                const descMatch = (task.description || '').toLowerCase().includes(searchTerm);
                const priorityMatch = !priorityVal || task.priority === priorityVal;
                const statusMatch = !statusVal || task.status === statusVal;

                return (titleMatch || descMatch) && priorityMatch && statusMatch;
            });

            // Sorting
            if (sortVal === 'asc') {
                filteredTasks.sort((a, b) => {
                    if (!a.deadline) return 1;
                    if (!b.deadline) return -1;
                    return new Date(a.deadline) - new Date(b.deadline);
                });
            } else if (sortVal === 'desc') {
                filteredTasks.sort((a, b) => {
                    if (!a.deadline) return 1;
                    if (!b.deadline) return -1;
                    return new Date(b.deadline) - new Date(a.deadline);
                });
            } else if (sortVal === 'priority') {
                const priorityOrder = { high: 1, medium: 2, low: 3 };
                filteredTasks.sort((a, b) => priorityOrder[a.priority] - priorityOrder[b.priority]);
            }

            renderTasks(filteredTasks);
        }

        function renderTasks(tasks) {
            const tbody = document.getElementById('tasksBody');
            tbody.innerHTML = '';

            if (tasks.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="table-cell text-center text-gray-500 py-8">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-3xl">📭</span>
                                <p>No tasks found. Try adjusting your filters.</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            tasks.forEach(task => {
                const isCompleted = task.status === 'done';
                const isOverdue = new Date(task.deadline) < new Date() && task.status !== 'done' && task.deadline;

                const row = document.createElement('tr');
                row.className = `table-body-row task-row ${isCompleted ? 'table-body-row--completed' : ''}`;
                row.dataset.id = task.id;
                row.dataset.priority = task.priority;
                row.dataset.status = task.status;
                row.dataset.deadline = task.deadline;

                row.innerHTML = `
                    <td class="table-cell font-semibold ${isCompleted ? 'line-through text-gray-500 dark:text-gray-400' : ''}">
                        ${task.title}
                    </td>
                    <td class="table-cell text-sm">${(task.description || '').substring(0, 50)}</td>
                    <td class="table-cell">
                        <select class="priority-select px-2 py-1 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" data-task-id="${task.id}">
                            <option value="high" ${task.priority === 'high' ? 'selected' : ''}>🔴 High</option>
                            <option value="medium" ${task.priority === 'medium' ? 'selected' : ''}>🟡 Medium</option>
                            <option value="low" ${task.priority === 'low' ? 'selected' : ''}>🟢 Low</option>
                        </select>
                    </td>
                    <td class="table-cell">
                        <select class="status-select px-2 py-1 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" data-task-id="${task.id}">
                            <option value="todo" ${task.status === 'todo' ? 'selected' : ''}>📋 To Do</option>
                            <option value="in_progress" ${task.status === 'in_progress' ? 'selected' : ''}>⏳ In Progress</option>
                            <option value="done" ${task.status === 'done' ? 'selected' : ''}>✅ Done</option>
                        </select>
                    </td>
                    <td class="table-cell text-sm">
                        <span class="inline-block px-3 py-1 rounded-full ${isOverdue ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200'}">
                            ${task.deadline ? new Date(task.deadline).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '—'}
                        </span>
                    </td>
                    <td class="table-cell">
                        <div class="flex gap-2">
                            <button class="edit-btn action-btn action-btn--edit" data-id="${task.id}" title="Edit">✎</button>
                            <button class="delete-btn action-btn action-btn--delete" data-id="${task.id}" title="Delete">✕</button>
                        </div>
                    </td>
                `;

                tbody.appendChild(row);

                // Add event listeners to newly created elements
                row.querySelector('.priority-select').addEventListener('change', updateTaskAttribute);
                row.querySelector('.status-select').addEventListener('change', updateTaskAttribute);
                row.querySelector('.edit-btn').addEventListener('click', (e) => openTaskModal(task.id));
                row.querySelector('.delete-btn').addEventListener('click', (e) => openDeleteModal(task.id));
            });
        }

        function updateTaskAttribute(e) {
            const taskId = e.target.dataset.taskId;
            const field = e.target.name.split('-')[0]; // 'priority' or 'status'
            const value = e.target.value;

            fetch(`/tasks/${taskId}/update-attribute`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ [field]: value })
            }).then(response => {
                if (response.ok) {
                    const taskIndex = allTasks.findIndex(t => t.id == taskId);
                    if (taskIndex >= 0) {
                        allTasks[taskIndex][field] = value;
                    }
                    applyFilters();
                }
            }).catch(error => console.error('Error:', error));
        }

        // ==================== DELETE OPERATIONS ====================
        function openDeleteModal(taskId) {
            currentTaskId = taskId;
            deleteModal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            currentTaskId = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', async () => {
            try {
                const response = await fetch(`/tasks/${currentTaskId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                if (response.ok) {
                    showNotification('Task deleted successfully', 'success');
                    closeDeleteModal();
                    allTasks = allTasks.filter(t => t.id != currentTaskId);
                    applyFilters();
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error deleting task', 'error');
            }
        });

        // ==================== UTILITY FUNCTIONS ====================
        function resetTaskFields() {
            taskFieldCount = 1;
            const fields = document.querySelectorAll('.task-field-group');
            fields.forEach((field, index) => {
                if (index > 0) field.remove();
                else field.querySelector('.remove-field').classList.add('hidden');
            });
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-[999]`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // ==================== EVENT LISTENERS ====================
        searchInput.addEventListener('input', applyFilters);
        priorityFilter.addEventListener('change', applyFilters);
        statusFilter.addEventListener('change', applyFilters);
        sortDeadline.addEventListener('change', applyFilters);

        document.getElementById('clearFilters').addEventListener('click', () => {
            searchInput.value = '';
            priorityFilter.value = '';
            statusFilter.value = '';
            sortDeadline.value = '';
            applyFilters();
        });

        // Initial render
        applyFilters();
    </script>
</x-app-layout>
