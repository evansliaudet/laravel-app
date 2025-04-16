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
            <h1 class="text-4xl font-bold">{{ $artist->firstname }} {{ $artist->name }}</h1>

            <img src="{{ asset('storage/uploads/artists/artist_' . $artist->id . '.' . $artist->image_extension) }}"    
                 alt="{{ $artist->firstname }} {{ $artist->name }}" 
                 class="w-full h-64 object-cover rounded-lg shadow-md mt-4">
            
            <div class="w-full mt-4">
                    <p class="text-3xl font-medium">{{ $artist->firstname }} {{ $artist->name }}</p>
                    <p>{{ $artist->country->name ?? 'Unknown Country' }}</p>
                    <p>Born in {{ $artist->birthdate ?? 'Unknown' }}</p>
            </div>

            <div class="w-full mt-4">
                <h2 class="text-2xl font-semibold">Movies</h2>
                <div class="grid grid-cols-1 gap-4 mt-2">
                    @forelse($artist->hasPlayed as $movie)
                        <div class="bg-gray-100 rounded-lg p-4 shadow-md flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold">{{ $movie->title }} ({{ $movie->year }})</h3>
                                <p class="text-gray-600 italic">Role: {{ $movie->pivot->role_name }}</p>
                            </div>
                            <a href="{{ route('movie.show', $movie->id) }}" 
                               class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700 transition whitespace-nowrap">
                                View Movie
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500">This artist hasn't played in any movies yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('artist.index') }}" class="text-indigo-600 hover:underline">Back to Artists</a>
            </div>
        </div>
    </div>
</x-guest-layout>

