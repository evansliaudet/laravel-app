<x-guest-layout>
    <div class="h-screen flex flex-col gap-5 justify-center items-center">
        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th class="text-start">{{ __('Name') }}</th>
                    <th class="text-start">{{ __('Firstname') }}</th>
                    <th class="text-start">{{ __('Country') }}</th>
                    <th class="text-start">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artists as $artist)
                    <tr>
                        <td>{{ $artist->name }}</td>
                        <td>{{ $artist->firstname }}</td>
                        <td>{{ $artist->country->name }}</td>
                        <td class="table-action"> <a href="{{ route('artist.edit', $artist->id) }}">
                                {{ __('Edit') }}
                            </a>
                            <a href="{{ route('artist.destroy', $artist->id) }}" class="text-red-500 delete">
                                {{ __('Delete') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="absolute bottom-5">
            {{ $artists->links() }}
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