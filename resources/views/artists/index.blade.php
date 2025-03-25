<x-guest-layout>
    <table class="table table-striped table-centered">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Firstname') }}</th>
                <th>{{ __('Country') }}</th>
                <th>{{ __('Actions') }}</th>
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
                        <a href="{{ route('artist.destroy', $artist->id) }}" class="text-red-500">
                            {{ __('Delete') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $artists->links() }}
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