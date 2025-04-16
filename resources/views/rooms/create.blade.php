<x-app-layout>
    <form method="POST" action="{{ route('room.store') }}" class="flex items-center justify-center p-5 h-screen">
        @csrf
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ __('New Room') }}</h1>
            
            <p class="flex flex-col w-full">
                <label for="name">{{ __('Name') }}</label>
                <x-input type="text" name="name" id="name" required />
            </p>

            <p class="flex flex-col w-full">
                <label for="capacity">{{ __('Capacity') }}</label>
                <x-input type="number" name="capacity" id="capacity" required min="1" />
            </p>

            <p class="flex flex-col w-full">
                <label for="cinema_id">{{ __('Cinema') }}</label>
                <select name="cinema_id" id="cinema_id" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach($cinemas as $cinema)
                        <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                    @endforeach
                </select>
            </p>

            <x-button type="submit">{{ __('Create') }}</x-button>
        </div>
    </form>
</x-app-layout>
