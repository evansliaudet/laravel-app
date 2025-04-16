<x-guest-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="flex items-center justify-center p-5 min-h-screen">
        <div class="max-w-lg w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ $movie->title }} ({{ $movie->year }})</h1>

            <img src="{{ asset('storage/uploads/posters/poster_' . $movie->id . '.png') }}" 
                 alt="{{ $movie->title }}" 
                 class="w-full h-64 object-cover rounded-lg shadow-md mt-4">

            <h2 class="text-2xl font-semibold mt-4">Cast</h2>

            <div class="grid grid-cols-1 gap-4 w-full">
                @foreach($cast as $actor)
                    <div class="bg-gray-100 rounded-lg p-4 shadow-md flex flex-col items-center w-full">
                        <h3 class="text-lg font-bold">{{ $actor->firstname }} {{ $actor->lastname }}</h3>
                        <p class="text-gray-600 italic">as {{ $actor->pivot->role_name }}</p>
                       
                    </div>
                    <form method="POST" action="{{ route('movie.detach', ['movie' => $movie->id, 'artist' => $actor->id]) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md text-sm hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                @endforeach
            </div>

            <form method="POST" action="{{ route('movie.attach', $movie->id) }}" class="w-full mt-6">
                {{ csrf_field() }}
                <p class="flex flex-col w-full mb-4">
                    <label for="actor_id" class="font-semibold">Actor</label>
                    <select name="actor_id" id="actor_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">
                                {{ $artist->firstname }} {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </p>
                <p class="flex flex-col w-full mb-4">
                    <label for="role" class="font-semibold">Role</label>
                    <input type="text" name="role" id="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                </p>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
            </form>

            <h2 class="text-2xl font-semibold mt-4">Screenings</h2>
            <div class="grid grid-cols-1 gap-4 w-full">
                @forelse($movie->cinemas as $cinema)
                    <div class="bg-gray-100 rounded-lg p-4 shadow-md flex justify-between items-center w-full">
                        <div>
                            <h3 class="text-lg font-bold">{{ $cinema->name }}</h3>
                            <p class="text-gray-600">{{ $cinema->address }}</p>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($cinema->pivot->screening_time)->format('d/m/Y H:i') }}</p>
                        </div>
                        <a href="{{ route('cinema.show', $cinema->id) }}" 
                           class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700 transition">
                            View Cinema
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">No screenings scheduled for this movie.</p>
                @endforelse
            </div>

            <div class="mt-4">
                <a href="{{ route('movie.index') }}" class="text-indigo-600 hover:underline">Back to Movies</a>
            </div>
        </div>
    </div>
</x-guest-layout>