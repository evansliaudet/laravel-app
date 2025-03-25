<x-guest-layout>
    <form method="POST" action="{{ route('artist.update', $artist->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $artist->name }}" required />
        </p>
        <p>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname" value="{{ $artist->firstname }}" required />
        </p>
        <p>
            <select name="country_id" id="country_id" required>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ $country->id == $artist->country_id ? 'selected="selected"' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <button type="submit">Update</button>
    </form>
</x-guest-layout>