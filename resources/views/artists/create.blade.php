<x-app-layout>
    <form method="POST" action="{{ route('artist.store') }}" class="flex items-center justify-center p-5 h-screen" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">Add an artist</h1>

            <div>
                <label for="poster">Poster</label>
                <input type="file" name="poster" id="poster" accept="image/*" required>
            </div>
            <p class=" flex flex-col w-full">
                <label for="name">Name</label>
                <x-input type="text" name="name" id="name" value="" required />
            </p>
            <p class="flex flex-col w-full">
                <label for="firstname">Firstname</label>
                <x-input type="text" name="firstname" id="firstname" value="" required />
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
            <x-button type="submit">Create</x-button>
        </div>
    </form>
</x-app-layout>