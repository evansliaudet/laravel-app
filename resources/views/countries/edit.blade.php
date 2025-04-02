<x-app-layout>
    <form method="POST" action="{{ route('country.update', $country->id) }}"
        class="flex items-center justify-center p-5 h-screen">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <p class="flex flex-col w-full">
                <label for="name">Name</label>
                <x-input type="text" name="name" id="name" value="{{ $country->name }}" required />
            </p>
            <x-button type="submit">Update</x-button>
        </div>
    </form>
</x-app-layout>