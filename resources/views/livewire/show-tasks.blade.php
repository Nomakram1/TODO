<div class="p-6">
    <div class="flex space-x-2">
    <div wire:click="selectTask('all')" class="{{ $selectedTask === 'all' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white">All Tasks</div>
    <div wire:click="selectTask('today')" class="{{ $selectedTask === 'today' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white">Today Tasks</div>
    <div wire:click="selectTask('tomorrow')" class="{{ $selectedTask === 'tomorrow' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white">Tomorrow Tasks</div>
    <div wire:click="selectTask('next_week')" class="{{ $selectedTask === 'next_week' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white">Next Week Tasks</div>
    <div wire:click="selectTask('near_future')" class="{{ $selectedTask === 'near_future' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white">Near Future Tasks</div>
    <div wire:click="selectTask('future')" class="{{ $selectedTask === 'future' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white inline-block">Future Tasks</div>
    <div wire:click="selectTask('completed')" class="{{ $selectedTask === 'completed' ? 'bg-black text-white' : 'bg-gray-200 text-black' }} flex-grow p-2 rounded border border-gray-300 cursor-pointer transition-all duration-300 hover:bg-black hover:text-white inline-block">Completed Tasks</div>
</div>
    <ul class="mt-4 space-y-4">
    @foreach($tasks as $task)
        <li>
            <div class="{{ $selectedTask === $task->title ? 'bg-gray-100' : 'bg-white' }} p-4 rounded cursor-pointer">
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-lg">{{ $task->title }}</p>
                    @if($task->completed)
                        <span class="inline-block bg-green-500 rounded-full px-2 py-1 text-sm text-white mr-2">Completed</span>
                    @else   
                        <input type="checkbox" wire:click="markComplete('{{$task->id}}')" class="mr-2">
                    @endif
                </div>
                <div class="{{ $selectedTask === $task->title ? 'hidden' : '' }}">
                    <p>{{ $task->description }}</p>
                    <p class="text-gray-600">{{ $task->due_date }}</p>
                    <div class="mt-2">
                        @if($task->taskGroup && $task->taskGroup->title)
                            <span class="inline-block relative group">
                                <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-sm text-gray-700 mr-2">
                                    {{ $task->taskGroup->title }}
                                </span>
                                <span class="absolute top-0 left-0 mt-8 p-2 bg-gray-800 text-white text-xs rounded opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-opacity duration-300">
                                    Des: {{ $task->taskGroup->description }}
                                </span>
                            </span>
                        @endif
                    </div>
            </div>  
        </li>
    @endforeach
</ul>

</div>

