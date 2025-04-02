<x-app-layout>
    <div class="h-screen flex flex-col gap-5 justify-center items-center p-6 bg-gray-100">
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-4">
            <a href="{{ route('movie.create') }}"
                class="border border-green-500 bg-green-100 rounded text-green-700 py-2 px-8 cursor-pointer transition ease-in-out duration-300 hover:bg-green-200">Create</a>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-5">
                @foreach($movies as $movie)
                    <div>
                        <a href="{{ route('movie.show', $movie->id) }}"
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ asset('storage/uploads/posters/poster_' . $movie->id . '.png') }}"
                                alt="{{ $movie->title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $movie->year }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $movie->director->name ?? "Unknown" }} {{ $movie->director->firstname ?? "" }}
                                </p>
                                <p class="text-sm text-gray-600">{{ $movie->country->name ?? "Unknown" }}</p>
                                <div class="flex gap-2 mt-3">
                                    <a href="{{ route('movie.edit', $movie->id) }}" class="text-blue-600 hover:underline">
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('movie.destroy', $movie->id) }}"
                                        class="text-red-600 hover:underline delete">
                                        {{ __('Delete') }}
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
            <div class="mt-4">
                {{ $movies->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            document.querySelectorAll('.delete').forEach(item => {
                item.addEventListener('click', event => {
                    event.preventDefault();
                    if (confirm('Are you sure you want to delete this movie?')) {
                        fetch(event.target.href, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': token
                            },
                            method: 'DELETE',
                        }).then(response => response.json())
                            .then(data => location.reload());
                    }
                });
            });
        });
    </script>
</x-app-layout>