<header class="sticky top-0 z-30 flex w-full p-3  border-gray-200 bg-white lg:border-b shadow-sm">
    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-1 py-1 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-1">
            <img class="h-6 w-auto" src="{{ asset('tailadmin/build/src/images/logo/logo.svg') }}" alt="Logo" />
        </div>

        <!-- User Area -->
        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
            <a class="flex items-center text-gray-700" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">
                <span class="mr-3 h-11 w-11 overflow-hidden rounded-full">
                    <img src="{{ asset('storage/user/' . Auth::user()->images) }}" alt="User" />
                </span>

                <span class="text-theme-sm mr-1 block font-medium"> {{ Auth::user()->name }} </span>

                <svg :class="dropdownOpen && 'rotate-180'" class="stroke-gray-500" width="18" height="20"
                    viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.3125 8.65625L9 13.3437L13.6875 8.65625" stroke="" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>

            <!-- Dropdown Start -->
            <div x-show="dropdownOpen"
                class="shadow-theme-lg absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3">

                <ul class="flex flex-col gap-1 border-gray-200 pt-4 pb-3">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700">
                            <i class="far fa-user-circle"></i>
                            Edit profile
                        </a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li>
                            <a href="{{ route('logout') }}"
                                class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="far fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </li>
                    </form>
                </ul>
            </div>
            <!-- Dropdown End -->
        </div>
        <!-- User Area -->
    </div>
</header>
