<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100">
                📋 Task Board
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
                            ➕ Create Task
                        </button>
                        <button id="createMultipleBtn" class="btn btn--secondary">
                            ⚡ Bulk Create
                        </button>
                        <a href="{{ route('tasks.archived') }}" class="btn btn--secondary">
                            📦 Archived
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="flex gap-6 text-sm">
                        <span class="text-gray-600 dark:text-gray-400"><strong>Total:</strong> <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $totalTasks }}</span></span>
                        <span class="text-gray-600 dark:text-gray-400"><strong>Overdue:</strong> <span class="font-semibold text-red-600 dark:text-red-400">{{ $overdueCount }}</span></span>
                    </div>
                </div>

                <!-- Search & Filter Row -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <!-- Search Input -->
                    <div>
                        <input type="text" id="searchInput" placeholder="🔍 Search tasks..."
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

                    <!-- Clear Button -->
                    <div>
                        <button id="clearFilters" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                            ✖️ Clear Filters
                        </button>
                    </div>
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
                                        <button class="archive-btn action-btn action-btn--warning" data-id="{{ $task->id }}" title="Archive">📦</button>
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
        /* Kanban Column Styles */
        .kanban-column {
            @apply bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4 flex flex-col h-fit;
            min-height: 600px;
        }

        .kanban-header {
            @apply flex items-center justify-between mb-4 pb-3;
        }

        .kanban-count {
            @apply inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300;
        }

        .kanban-tasks {
            @apply space-y-3 flex-1 overflow-y-auto pr-2;
        }

        .kanban-tasks::-webkit-scrollbar {
            @apply w-2;
        }

        .kanban-tasks::-webkit-scrollbar-track {
            @apply bg-gray-100 dark:bg-gray-700 rounded-lg;
        }

        .kanban-tasks::-webkit-scrollbar-thumb {
            @apply bg-gray-300 dark:bg-gray-600 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500;
        }

        .task-card {
            @apply p-3 rounded-lg cursor-grab transition-all bg-white dark:bg-gray-750 select-none border border-gray-100 dark:border-gray-700;
            animation: slideIn 0.3s ease-out;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .task-card:hover {
            @apply transform -translate-y-1 shadow-md;
        }

        .task-card.dragging {
            @apply opacity-50 cursor-grabbing shadow-lg;
        }

        .kanban-tasks.drag-over {
            @apply bg-blue-50 dark:bg-blue-900/10 rounded-lg;
        }

        .task-card-title {
            @apply font-semibold text-gray-900 dark:text-white text-sm mb-1;
        }

        .task-card-desc {
            @apply text-xs text-gray-600 dark:text-gray-400 mb-2;
        }

        .task-card-footer {
            @apply flex items-center gap-2 flex-wrap text-xs;
        }

        .task-card-deadline {
            @apply inline-flex items-center gap-1 px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300;
        }

        .task-card-deadline-overdue {
            @apply bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400;
        }

        .task-card-actions {
            @apply flex items-center gap-1 ml-auto;
        }

        .task-card-btn {
            @apply px-1.5 py-0.5 text-xs rounded font-medium transition-colors cursor-pointer hover:opacity-80;
        }

        .task-card-btn-edit {
            @apply text-blue-600 dark:text-blue-400;
        }

        .task-card-btn-delete {
            @apply text-red-600 dark:text-red-400;
        }

        .task-card-btn-archive {
            @apply text-orange-600 dark:text-orange-400;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    </style>

    <!-- ======================== JAVASCRIPT ======================== -->
    <script>
        // ==================== STATE ====================
        let allTasks = @json($tasks);
        let filteredTasks = [...allTasks];
        let currentTaskId = null;

        // ==================== DOM ELEMENTS ====================
        const taskModal = document.getElementById('taskModal');
        const multipleModal = document.getElementById('multipleModal');
        const deleteModal = document.getElementById('deleteModal');
        const taskForm = document.getElementById('taskForm');
        const multipleTasksForm = document.getElementById('multipleTasksForm');
        const searchInput = document.getElementById('searchInput');
        const priorityFilter = document.getElementById('priorityFilter');
        const tasksContainer = document.getElementById('tasksContainer');

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

            // Clear previous errors
            document.querySelectorAll('.error-text').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
            document.querySelectorAll('input, select, textarea').forEach(el => {
                el.classList.remove('border-red-500');
            });

            const formData = new FormData(taskForm);
            const data = {};

            data.title = formData.get('title');
            data.description = formData.get('description') || null;
            data.priority = formData.get('priority');
            data.status = 'todo';
            data.deadline = formData.get('deadline') || null;

            // Client-side validation
            let hasErrors = false;
            
            if (!data.title || data.title.trim() === '') {
                showFieldError('title', 'Title is required');
                hasErrors = true;
            }
            
            if (!data.priority) {
                showFieldError('priority', 'Priority is required');
                hasErrors = true;
            }
            
            if (data.deadline && new Date(data.deadline) <= new Date()) {
                showFieldError('deadline', 'Deadline must be in the future');
                hasErrors = true;
            }
            
            if (hasErrors) return;

            const url = currentTaskId ? `/tasks/${currentTaskId}` : '/tasks';
            const method = currentTaskId ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    const result = await response.json();
                    showNotification(result.message || 'Task saved successfully!', 'success');
                    closeTaskModal();
                    location.reload();
                } else {
                    const error = await response.json();
                    if (error.errors) {
                        // Handle Laravel validation errors
                        Object.keys(error.errors).forEach(field => {
                            showFieldError(field, error.errors[field][0]);
                        });
                    } else {
                        showNotification(error.message || 'Error saving task', 'error');
                    }
                }
            } catch (error) {
                console.error('Fetch error:', error);
                showNotification('An error occurred', 'error');
            }
        });

        function showFieldError(fieldName, message) {
            const field = document.getElementById(fieldName);
            const errorEl = field.parentNode.querySelector('.error-text');
            
            field.classList.add('border-red-500');
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        }

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

            newField.innerHTML = newField.innerHTML
                .replace(/tasks\[0\]/g, `tasks[${taskFieldCount - 1}]`)
                .replace(/Task 1/, `Task ${taskFieldCount}`);

            newField.querySelector('.remove-field').classList.remove('hidden');

            tasksContainer.appendChild(newField);

            newField.querySelector('.remove-field').addEventListener('click', (e) => {
                e.preventDefault();
                newField.remove();
                taskFieldCount--;
            });
        });

        // ==================== FILTERING & RENDERING ====================
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const priorityVal = priorityFilter.value;

            const rows = document.querySelectorAll('.task-row');
            rows.forEach(row => {
                const title = row.querySelector('.font-semibold').textContent.toLowerCase();
                const description = row.querySelector('.text-sm').textContent.toLowerCase();
                const priority = row.dataset.priority;

                const titleMatch = title.includes(searchTerm);
                const descMatch = description.includes(searchTerm);
                const priorityMatch = !priorityVal || priority === priorityVal;

                if ((titleMatch || descMatch) && priorityMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function updateTaskAttribute(e) {
            const taskId = e.target.dataset.taskId;
            const field = e.target.classList.contains('priority-select') ? 'priority' : 'status';
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
                    showNotification(`Task ${field} updated!`, 'success');
                    if (field === 'status' && value === 'done') {
                        const row = e.target.closest('tr');
                        row.classList.add('table-body-row--completed');
                        row.querySelector('.font-semibold').classList.add('line-through', 'text-gray-500', 'dark:text-gray-400');
                    }
                }
            }).catch(error => {
                console.error('Error:', error);
                showNotification('Error updating task', 'error');
            });
        }

        // ==================== TASK OPERATIONS ====================
        function openDeleteModal(taskId) {
            currentTaskId = taskId;
            deleteModal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            currentTaskId = null;
        }

        function archiveTask(taskId) {
            if (confirm('Are you sure you want to archive this task?')) {
                fetch(`/tasks/${taskId}/archive`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
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
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

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

        document.getElementById('clearFilters').addEventListener('click', () => {
            searchInput.value = '';
            priorityFilter.value = '';
            applyFilters();
        });

        // Add event listeners for table elements
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.priority-select').forEach(select => {
                select.addEventListener('change', updateTaskAttribute);
            });

            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', updateTaskAttribute);
            });

            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const taskId = e.target.dataset.id;
                    openTaskModal(taskId);
                });
            });

            document.querySelectorAll('.archive-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const taskId = e.target.dataset.id;
                    archiveTask(taskId);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const taskId = e.target.dataset.id;
                    openDeleteModal(taskId);
                });
            });
        });

        // Initial filter application
        applyFilters();
    </script>
</x-app-layout>
