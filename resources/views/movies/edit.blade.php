<x-app-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('movie.update', $movie->id) }}"
        class="flex items-center justify-center p-5 h-screen">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">Ajouter un film</h1>
            <p class=" flex flex-col w-full">
                <label for="title">Title</label>
                <x-input type="text" name="title" id="title" value="{{ $movie->title }}" required />
            </p>
            <p class="flex flex-col w-full">
                <label for="year">Year</label>
                <x-input type="number" name="year" id="year" value="{{ $movie->year }}" required />
            </p>
            <p class="flex flex-col w-full">
                <label for="year">Director</label>
                <select name="director_id" id="director_id" required>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $artist->id == $movie->director_id ? 'selected="selected"' : '' }}>
                            {{ $artist->name }} {{ $artist->firstname }}
                        </option>
                    @endforeach
                </select>
            </p>
            <p class="flex flex-col w-full">
                <label for="year">Country</label>
                <select name="country_id" id="country_id" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id == $movie->country_id ? 'selected="selected"' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </p>
            <x-button type="submit">Update</x-button>
        </div>
    </form>
</x-app-layout>