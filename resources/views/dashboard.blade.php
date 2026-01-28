<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100">
                Task Manager Dashboard
            </h2>
            <div class="text-gray-600 dark:text-gray-400 text-sm font-mono">
                {{ now()->format('M d, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Statistics Row - Horizontal Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
                <!-- Total Tasks -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Tasks</span>
                            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V3z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">24</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">All your tasks</p>
                    </div>
                </div>

                <!-- Todo Tasks -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">To Do</span>
                            <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">08</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Pending</p>
                    </div>
                </div>

                <!-- In Progress -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Progress</span>
                            <div class="w-10 h-10 rounded-xl bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-2a4 4 0 00-8 0v2h8z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">06</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">In progress</p>
                    </div>
                </div>

                <!-- Done Tasks -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Done</span>
                            <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">10</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Completed</p>
                    </div>
                </div>

                <!-- Late Tasks -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Late</span>
                            <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 110 6a.5.5 0 10 1 0 5a5 5 0 1110 0 .5.5 0 10 1 0 6A6 6 0 1113.477 14.89z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">02</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Overdue</p>
                    </div>
                </div>

                <!-- Completion Rate -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Complete</span>
                            <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">42%</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Completion</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Chart Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Quick Actions -->
                <div class="lg:col-span-1 space-y-3">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white px-1">Quick Actions</h3>
                    <a href="#" class="flex items-center justify-between w-full bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 group border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">New Task</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between w-full bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 group border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM13 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">All Tasks</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between w-full bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 group border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900 flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0015.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">Search</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>

                <!-- Progress Chart -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-6">Completion Progress</h3>

                    <div class="space-y-6">
                        <!-- Overall Progress -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Overall Progress</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-white">42%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2.5 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>

                        <!-- Done Progress -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed Tasks</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-white">10/24</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 h-2.5 rounded-full" style="width: 41.66%"></div>
                            </div>
                        </div>

                        <!-- In Progress -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">In Progress</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-white">6/24</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-2.5 rounded-full" style="width: 25%"></div>
                            </div>
                        </div>

                        <!-- Pending -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Tasks</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-white">8/24</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2.5 rounded-full" style="width: 33.33%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tasks Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Tasks</h3>
                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">View all →</a>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Task Item 1 -->
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4 flex-1">
                                <input type="checkbox" class="w-5 h-5 mt-1 rounded border-gray-300 dark:border-gray-600 cursor-pointer">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Complete Project Documentation</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Finish all technical documentation for Q1 release</p>
                                    <div class="flex items-center gap-3 mt-3">
                                        <span class="inline-block px-3 py-1 bg-black text-white text-xs font-semibold rounded-full">High</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">📅 Due: Feb 15</span>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-xs font-semibold rounded-lg ml-4">In Progress</span>
                        </div>
                    </div>

                    <!-- Task Item 2 -->
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4 flex-1">
                                <input type="checkbox" class="w-5 h-5 mt-1 rounded border-gray-300 dark:border-gray-600 cursor-pointer">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Review Code Changes</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Review pull requests from the frontend team</p>
                                    <div class="flex items-center gap-3 mt-3">
                                        <span class="inline-block px-3 py-1 bg-gray-300 text-gray-800 text-xs font-semibold rounded-full">Medium</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">📅 Due: Feb 10</span>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-semibold rounded-lg ml-4">To Do</span>
                        </div>
                    </div>

                    <!-- Task Item 3 -->
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors bg-gray-50/50 dark:bg-gray-700/20">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4 flex-1">
                                <input type="checkbox" class="w-5 h-5 mt-1 rounded border-gray-300 dark:border-gray-600 cursor-pointer" checked>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white line-through text-gray-500 dark:text-gray-400">Deploy to Production</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Push version 2.1.0 to production servers</p>
                                    <div class="flex items-center gap-3 mt-3">
                                        <span class="inline-block px-3 py-1 bg-black text-white text-xs font-semibold rounded-full">High</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">📅 Due: Feb 05</span>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-semibold rounded-lg ml-4">Done</span>
                        </div>
                    </div>

                    <!-- Task Item 4 -->
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border-t-2 border-red-200 dark:border-red-900">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4 flex-1">
                                <input type="checkbox" class="w-5 h-5 mt-1 rounded border-gray-300 dark:border-gray-600 cursor-pointer">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Update Dependencies</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Update npm packages to latest versions</p>
                                    <div class="flex items-center gap-3 mt-3">
                                        <span class="inline-block px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full">Low</span>
                                        <span class="text-xs text-red-600 dark:text-red-400">⚠️ Overdue: Feb 01</span>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-xs font-semibold rounded-lg ml-4">Late</span>
                        </div>
                    </div>

                    <!-- Task Item 5 -->
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4 flex-1">
                                <input type="checkbox" class="w-5 h-5 mt-1 rounded border-gray-300 dark:border-gray-600 cursor-pointer">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Team Meeting</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Weekly sync with the development team</p>
                                    <div class="flex items-center gap-3 mt-3">
                                        <span class="inline-block px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full">Low</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">📅 Due: Feb 12</span>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-semibold rounded-lg ml-4">To Do</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
