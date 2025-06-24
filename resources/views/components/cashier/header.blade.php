<header 
    x-data="{ 
        sidebarToggle: false, 
        dropdownOpen: false 
    }" 
    class="sticky top-0 z-30 flex w-full border-gray-200 bg-white"
>
    <div class="flex w-full flex-col items-center justify-between lg:flex-row lg:px-6">
        <div class="flex w-full items-center justify-between border-b border-gray-200 px-3 py-3 lg:border-b-0 lg:px-0 lg:py-4">
            <a href="#">
                <img class="h-8 w-auto block " src="{{ asset('tailadmin/build/src/images/logo/logo.svg') }}" alt="Logo">
            </a>

            <!-- Profile Dropdown -->
            <div class="relative" @click.outside="dropdownOpen = false">
                <a href="#" @click.prevent="dropdownOpen = !dropdownOpen" class="flex items-center text-gray-700 ">
                    <span class="mr-3 h-11 w-11 overflow-hidden rounded-full border">
                        <img src="{{ asset('storage/user/' . (Auth::user()->images ?? 'default.png')) }}" alt="User" class="object-cover h-full w-full">
                    </span>
                    <span class="text-sm font-medium mr-1">{{ Auth::user()->name }}</span>
                    <svg :class="{ 'rotate-180': dropdownOpen }" class="transition-transform stroke-gray-500 dark:stroke-gray-300" width="18" height="20" viewBox="0 0 18 20">
                        <path d="M4.31 8.66L9 13.34l4.69-4.69" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <!-- Dropdown Menu -->
                <div 
                    x-show="dropdownOpen" 
                    x-transition 
                    class="absolute right-0 mt-4 w-64 rounded-2xl border border-gray-200 bg-white shadow-lg p-3 z-50"
                >
                    <ul class="flex flex-col gap-1 border-gray-200 py-3">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-700  hover:bg-gray-100 rounded-lg">
                                    <i class="far fa-sign-out-alt"></i> {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
