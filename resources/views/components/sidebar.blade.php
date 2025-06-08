<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 duration-300 ease-linear lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="sidebar-header flex items-center gap-2 pb-7 pt-8">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="h-10 w-auto" src="{{ asset('tailadmin/build/src/images/logo/logo.svg') }}" alt="Logo" />
                <img class="h-10 w-auto hidden" src="{{ asset('tailadmin/build/src/images/logo/logo-dark.svg') }}" alt="Logo" />
            </span>

            <img class="h-10 w-auto logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'" src="{{ asset('tailadmin/build/src/images/logo/logo-icon.svg') }}"
                alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: $persist('Dashboard') }">
            
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">MENU</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z" />
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="{{ route('dashboard') }}" class="menu-item group {{ request()->routeIs('dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fas fa-tachometer-alt-slow fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support Cashiers -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Cashiers</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="..."/>
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="{{ route('admin.cashier.index') }}" class="menu-item group {{ request()->routeIs('admin.cashier.*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fad fa-regular fa-users fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kasir</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Pill Section -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Pill</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="..."/>
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="{{ route('admin.pill.index') }}" class="menu-item group {{ request()->routeIs('admin.pill.*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fas fa-pills fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Obat</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Others Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Others</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="..."/>
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="/history" class="menu-item group {{ request()->routeIs('history') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fas fa-history fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">History</span>
                        </a>
                    </li>
                </ul>
            </div>

        </nav>
    </div>
</aside>
