<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="createTask">
                        @csrf
                        <!-- Task Title -->
                        <div class="mb-4">
                            <x-label for="title" :value="__('Task Title')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" wire:model.lazy="title" required autofocus />
                            @error('title')
                                    <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Task Description -->
                        <div class="mb-4">
                            <x-label for="description" :value="__('Task Description')" />

                            <textarea id="description" class="form-input mt-1 block w-full" wire:model.lazy="description"></textarea>
                        </div>

                        <!-- Recurrence Pattern -->
                        <div class="mb-4">
                            <x-label for="recurrence" :value="__('Recurrence Pattern')" />

                            <select id="recurrence" class="form-select mt-1 block w-full" wire:model="recurrence" required autofocus>
                                <option value="daily">Every Day</option>
                                <option value="monday">Every Monday</option>
                                <option value="tuesday">Every Tuesday</option>
                                <option value="wednesday">Every Wednesday</option>
                                <option value="friday">Every Friday</option>
                                <option value="fifth_each_month">Every 5th of each Month</option>
                                <option value="fifth_each_month">Every 5th of March of each Year</option>
                            </select>
                             @error('recurrence')
                                    <span class="text-red-500">{{ $message }}</span>
                             @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="taskGroupList" :value="__('Task Group')" />

                            <select id="taskGroupList" class="form-select mt-1 block w-full" wire:model="taskGroup">
                                @foreach ($taskGroups as $taskGroup)
                                    <option value="{{$taskGroup->id}}">{{$taskGroup->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <x-label for="duration" :value="__('Duration')" />

                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="durationType" value="from-to" wire:model="durationType">
                                    <span class="ml-2">From Date A to Date B</span>
                                </label>

                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="durationType" value="iteration" wire:model="durationType">
                                    <span class="ml-2">For N Iterations</span>
                                </label>
                            </div>
                        </div>
                        @if ($durationType === 'from-to')
                            <div class="mb-4">
                                <x-label for="start-date" :value="__('Start Date')" />

                                <x-input type="date" id="start-date" class="block mt-1 w-full" wire:model="startDate" required />
                                @error('startDate')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <x-label for="end-date" :value="__('End Date')" />

                                <x-input type="date" id="end-date" class="block mt-1 w-full" wire:model="endDate" required />
                                 @error('endDate')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <!-- Iterations Input (if 'iterations' selected) -->
                            <div class="mb-4">
                                <x-label for="iterations" :value="__('Number of Iterations')" />

                                <x-input type="number" id="iterations" class="block mt-1 w-full" wire:model="iterations" required />
                                @error('iterations')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create Task') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>