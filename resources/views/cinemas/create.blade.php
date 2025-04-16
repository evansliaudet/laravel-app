<x-app-layout>
    <form method="POST" action="{{ route('cinema.store') }}" class="flex items-center justify-center p-5 h-screen">
        @csrf
        <div class="max-w-sm w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ __('New Cinema') }}</h1>
            
            <p class="flex flex-col w-full">
                <label for="name">{{ __('Name') }}</label>
                <x-input type="text" name="name" id="name" required />
            </p>

            <p class="flex flex-col w-full">
                <label for="address">{{ __('Address') }}</label>
                <x-input type="text" name="address" id="address" required />
            </p>

            <p class="flex flex-col w-full">
                <label for="phone">{{ __('Phone') }}</label>
                <x-input type="text" name="phone" id="phone" required />
            </p>

            <p class="flex flex-col w-full">
                <label for="email">{{ __('Email') }}</label>
                <x-input type="email" name="email" id="email" required />
            </p>

            <x-button type="submit">{{ __('Create') }}</x-button>
        </div>
    </form>
</x-app-layout>
