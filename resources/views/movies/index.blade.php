<x-guest-layout>
    <div class="h-screen flex flex-col gap-5 justify-center items-center">
        <a href="{{ route('movie.create') }}"
            class="border border-green-500 bg-green-100 rounded text-green-700 py-1 px-6 cursor-pointer transition ease-in-out duration-300 hover:bg-green-200">Create</a>
        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th class="text-start">{{ __('Title') }}</th>
                    <th class="text-start">{{ __('Year') }}</th>
                    <th class="text-start">{{ __('Artist') }}</th>
                    <th class="text-start">{{ __('Role') }}</th>
                    <th class="text-start">{{ __('Country') }}</th>
                    <th class="text-start">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                        @foreach ($movie->director->hasPlayed as $artistMovie)
                                @if ($artistMovie->id == $movie->id)
                                        @php
                                            $role = $artistMovie->pivot->role_name;
                                        @endphp
                                @else
                                        @php
                                            $role = "Unknown";
                                        @endphp
                                @endif
                        @endforeach
                        <tr>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->year }}</td>
                            <td>{{ $movie->director->name }} {{ $movie->director->firstname }}</td>
                            <td>{{ $role }}</td>
                            <td>{{ $movie->country->name }}</td>
                            <td class="table-action"> <a href="{{ route('movie.edit', $movie->id) }}">
                                    {{ __('Edit') }}
                                </a>
                                <a href="{{ route('movie.destroy', $movie->id) }}" class="text-red-500 delete">
                                    {{ __('Delete') }}
                                </a>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>

        <div class="absolute bottom-5">
            {{ $movies->links() }}
        </div>

    </div>

    <script>
        // Récupération du token
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Ajout des événements
        document.querySelectorAll('.delete').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                // Requête AJAX de suppression
                fetch(event.target.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': token
                    },
                    method: 'DELETE',
                });
            })
        });
    </script>
</x-guest-layout>