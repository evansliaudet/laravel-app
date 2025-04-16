<x-app-layout>
    <form method="POST" action="{{ route('screening.update', $screening->id) }}" class="flex items-center justify-center p-5 h-screen">
        @csrf
        @method('PUT')
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ __('Edit Screening') }}</h1>
            
            <p class="flex flex-col w-full">
                <label for="movie_id">{{ __('Movie') }}</label>
                <select name="movie_id" id="movie_id" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}" {{ $movie->id == $screening->movie_id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p class="flex flex-col w-full">
                <label for="room_id">{{ __('Room') }}</label>
                <select name="room_id" id="room_id" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ $room->id == $screening->room_id ? 'selected' : '' }}>
                            {{ $room->cinema->name }} - {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p class="flex flex-col w-full">
                <label for="screening_time">{{ __('Screening Time') }}</label>
                <x-input type="datetime-local" name="screening_time" id="screening_time" 
                         value="{{ $screening->screening_time->format('Y-m-d\TH:i') }}" required />
            </p>

            <x-button type="submit">{{ __('Update') }}</x-button>
        </div>
    </form>
</x-app-layout>
