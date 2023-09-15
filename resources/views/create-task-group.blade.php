<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task Group Creation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   @livewire('create-task-group')
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('swal:modal', event => { 
                swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    confirmButtonColor: '#363333',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result) {
                        window.location.href = "{{ route('create') }}";
                    }
                });
            });
    </script>
</x-app-layout>
