<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="/movie" :active="request()->is('movie')">
                        Movies
                    </x-nav-link>
                    <x-nav-link href="/artist" :active="request()->is('artist')">
                        Artists
                    </x-nav-link>
                    <x-nav-link href="/country" :active="request()->is('country')">
                        Countries
                    </x-nav-link>
                    <x-nav-link :href="route('cinema.index')" :active="request()->routeIs('cinema.*')">
                        {{ __('Cinemas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('room.index')" :active="request()->routeIs('room.*')">
                        {{ __('Rooms') }}
                    </x-nav-link>
                    <x-nav-link :href="route('screening.index')" :active="request()->routeIs('screening.*')">
                        {{ __('Screenings') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/movie" :active="request()->is('movie')">
                Movies
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/artist" :active="request()->is('artist')">
                Artists
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/country" :active="request()->is('country')">
                Countries
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cinema.index')" :active="request()->routeIs('cinema.*')">
                {{ __('Cinemas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('room.index')" :active="request()->routeIs('room.*')">
                {{ __('Rooms') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('screening.index')" :active="request()->routeIs('screening.*')">
                {{ __('Screenings') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="space-y-1">
                <x-responsive-nav-link href="{{ route('login') }}">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('register') }}">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
