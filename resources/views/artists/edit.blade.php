<x-guest-layout>
    <form method="POST" action="{{ route('artist.update', $artist->id) }}"
        class="flex items-center justify-center p-5 h-screen">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
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
</x-guest-layout>