<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">My Tasks</h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @foreach($tasks as $task)
                        <div class="border-b pb-4 mb-4">
                            <h3 class="font-semibold">{{ $task->title }}</h3>
                            <p class="text-gray-600">{{ $task->description }}</p>
                            <span class="badge badge--{{ $task->priority }}">{{ $task->priority }}</span>
                            <span class="badge badge--{{ $task->status }}">{{ $task->status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
