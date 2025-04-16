<x-app-layout>
    <form method="POST" action="{{ route('cinema.update', $cinema->id) }}" class="flex items-center justify-center p-5 h-screen">
        @csrf
        @method('PUT')
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ __('Edit Cinema') }}</h1>
            
            <p class="flex flex-col w-full">
                <label for="name">{{ __('Name') }}</label>
                <x-input type="text" name="name" id="name" value="{{ $cinema->name }}" required />
            </p>

            <p class="flex flex-col w-full">
                <label for="address">{{ __('Address') }}</label>
                <x-input type="text" name="address" id="address" value="{{ $cinema->address }}" required />
            </p>

            <p class="flex flex-col w-full">
                <label for="phone">{{ __('Phone') }}</label>
                <x-input type="text" name="phone" id="phone" value="{{ $cinema->phone }}" required />
            </p>

            <x-button type="submit">{{ __('Update') }}</x-button>
        </div>
    </form>
</x-app-layout>
