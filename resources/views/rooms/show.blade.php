<x-guest-layout>
    <div class="flex items-center justify-center p-5 min-h-screen">
        <div class="max-w-lg w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ $room->name }}</h1>

            <div class="w-full mt-4">
                <p class="text-xl">{{ __('Capacity') }}: {{ $room->capacity }}</p>
                <p class="text-xl">{{ __('Cinema') }}: {{ $room->cinema->name }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('room.index') }}" class="text-indigo-600 hover:underline">{{ __('Back to Rooms') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
