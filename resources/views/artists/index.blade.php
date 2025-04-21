<x-app-layout>
    <div class="h-screen flex flex-col gap-5 justify-center items-center p-6 bg-gray-100">
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-4">
            <a href="{{ route('artist.create') }}"
                class="border border-green-500 bg-green-100 rounded text-green-700 py-2 px-8 cursor-pointer transition ease-in-out duration-300 hover:bg-green-200">Create</a>
            <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-4 border border-black/9 mt-5">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                            <th class="text-left p-3">{{ __('Photo') }}</th>
                            <th class="text-left p-3">{{ __('Name') }}</th>
                            <th class="text-left p-3">{{ __('Firstname') }}</th>
                            <th class="text-left p-3">{{ __('Country') }}</th>
                            <th class="text-left p-3">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artists as $artist)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer" 
                                onclick="window.location.href='{{ route('artist.show', $artist->id) }}'">
                                <td>
                                <img src="{{ asset('storage/uploads/artists/artist_' . $artist->id . '.' . $artist->image_extension) }}" 
                                         alt="{{ $artist->firstname }}" 
                                         class="size-44 object-cover">
                                </td>
                                <td class="p-3">
                                    {{ $artist->name }}
                                </td>
                                <td class="p-3">{{ $artist->firstname }}</td>
                                <td class="p-3">{{ $artist->country->name ?? "Unknown" }}</td>
                                <td class="p-3 space-x-3">
                                    <a href="{{ route('artist.edit', $artist->id) }}" class="text-blue-600 hover:underline">
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('artist.destroy', $artist->id) }}" class="text-red-600 hover:underline delete">
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $artists->links() }}
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                document.querySelectorAll('.delete').forEach(item => {
                    item.addEventListener('click', event => {
                        event.preventDefault();
                        if (confirm('Are you sure you want to delete this artist?')) {
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