<x-app-layout>
    <form method="POST" action="{{ route('country.store') }}" class="flex items-center justify-center p-5 h-screen">
        {{ csrf_field() }}
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">Add a country</h1>
            <p class=" flex flex-col w-full">
                <label for="name">Name</label>
                <x-input type="text" name="name" id="name" value="" required />
            </p>
            <x-button type="submit">Create</x-button>
        </div>
    </form>
</x-app-layout>