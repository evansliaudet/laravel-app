<x-guest-layout>
    <div class="flex items-center justify-center p-5 min-h-screen">
        <div class="max-w-lg w-full flex flex-col gap-5 items-start">
            <h1 class="text-4xl font-bold">{{ __('Screening Details') }}</h1>

            <div class="w-full mt-4">
                <p class="text-xl font-bold">{{ __('Movie') }}: {{ $screening->movie->title }}</p>
                <p class="text-xl">{{ __('Cinema') }}: {{ $screening->room->cinema->name }}</p>
                <p class="text-xl">{{ __('Room') }}: {{ $screening->room->name }}</p>
                <p class="text-xl">{{ __('Screening Time') }}: {{ $screening->screening_time->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('screening.index') }}" class="text-indigo-600 hover:underline">{{ __('Back to Screenings') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
