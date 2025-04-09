<x-app-layout>
    <form method="POST" action="{{ route('artist.update', $artist->id) }}"
        class="flex items-center justify-center p-5 h-screen" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <div>
                <label for="poster">Photo</label>
                <input type="file" name="poster" id="poster" accept="image/*">
                @if($artist->poster)
                    <img src="{{ asset('storage/uploads/artists/' . $artist->poster) }}" alt="{{ $artist->name }}" class="w-32 h-32 object-cover rounded-lg mt-2">
                @endif
            </div>
            <p class="flex flex-col w-full">
                <label for="name">Name</label>
                <x-input type="text" name="name" id="name" value="{{ $artist->name }}" required />
            </p>
            <p class="flex flex-col w-full">
                <label for="firstname">Firstname</label>
                <x-input type="text" name="firstname" id="firstname" value="{{ $artist->firstname }}" required />
            </p>
            <p class="flex flex-col w-full">
                <select name="country_id" id="country_id" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id == $artist->country_id ? 'selected="selected"' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </p>
            <x-button type="submit">Update</x-button>
        </div>
    </form>
</x-app-layout>