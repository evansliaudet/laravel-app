<x-guest-layout>
    <div class="flex items-center justify-center p-5 min-h-screen">
        <div class="max-w-4xl w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ $cinema->name }}</h1>

            <div class="w-full mt-4">
                <p class="text-xl">{{ __('Address') }}: {{ $cinema->address }}</p>
                <p class="text-xl">{{ __('Phone') }}: {{ $cinema->phone }}</p>
            </div>

            <div class="w-full mt-4">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Rooms & Screenings') }}</h2>
                
                @foreach($cinema->rooms as $room)
                    <div class="bg-white shadow-lg rounded-lg p-4 mb-4">
                        <h3 class="text-xl font-bold mb-2">{{ $room->name }} ({{ __('Capacity') }}: {{ $room->capacity }})</h3>
                        
                        <div class="grid grid-cols-1 gap-4">
                            @forelse($room->screenings->sortBy('screening_time') as $screening)
                                <div class="bg-gray-100 rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <h4 class="font-bold">{{ $screening->movie->title }}</h4>
                                        <p class="text-gray-600">
                                            {{ $screening->screening_time->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <a href="{{ route('movie.show', $screening->movie) }}" 
                                       class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700 transition">
                                        {{ __('View Movie') }}
                                    </a>
                                </div>
                            @empty
                                <p class="text-gray-500">{{ __('No screenings scheduled in this room.') }}</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <a href="{{ route('cinema.index') }}" class="text-indigo-600 hover:underline">{{ __('Back to Cinemas') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
