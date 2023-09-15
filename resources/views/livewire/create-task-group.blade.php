<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="createTaskGroup">
                        @csrf
                        <!-- Task Title -->
                        <div class="mb-4">
                            <x-label for="title" :value="__('Task Group Title')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" wire:model.lazy="title" required autofocus />
                            
                            @error('title')
                                    <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Task Description -->
                        <div class="mb-4">
                            <x-label for="description" :value="__('Task Group Description')" />

                            <textarea id="description" class="form-input mt-1 block w-full" wire:model.lazy="description"></textarea>
                        
                        </div>
                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create Task Group') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

