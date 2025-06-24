<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 duration-300 ease-linear lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="sidebar-header flex items-center gap-2 pb-7 pt-8">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="h-10 w-auto" src="{{ asset('tailadmin/build/src/images/logo/logo.svg') }}" alt="Logo" />
                <img class="h-10 w-auto hidden" src="{{ asset('tailadmin/build/src/images/logo/logo-dark.svg') }}"
                    alt="Logo" />
            </span>

            <img class="h-10 w-auto logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('tailadmin/build/src/images/logo/logo-icon.svg') }}" alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: '',
                initDropdown() {
                    const currentUrl = window.location.href;
                    if (
                        currentUrl.includes('{{ route('admin.sale.index', [], false) }}') ||
                        currentUrl.includes('{{ route('admin.stock.index', [], false) }}')
                    ) {
                        this.selected = 'Task';
                    } else {
                        this.selected = '';
                    }
                }
            }" x-init="initDropdown()">


            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">MENU</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z" />
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="menu-item group {{ request()->routeIs('dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}">
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
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" />
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="{{ route('admin.cashier.index') }}"
                            class="menu-item group {{ request()->routeIs('admin.cashier.*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fad fa-regular fa-users fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kelola Kasir</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- medicine Section -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">medicine</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" />
                    </svg>
                </h3>
                <ul class="flex flex-col">
                    <li>
                        <a href="{{ route('admin.medicine.index') }}"
                            class="menu-item group {{ request()->routeIs('admin.medicine.*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fas fa-pills fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kelola Obat</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Report</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" />
                    </svg>
                </h3>

                <a href="#" @click.prevent="selected = (selected === 'Task' ? '' : 'Task')" class="menu-item group"
                    :class="selected === 'Task' ? 'menu-item-active' : 'menu-item-inactive'">
                    <i class="fas fa-history fa-lg"></i>
                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Laporan & Riwayat
                    </span>

                    <svg class="menu-item-arrow" :class="[
                selected === 'Task' ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive',
                sidebarToggle ? 'lg:hidden' : ''
            ]" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Dropdown Menu Start -->
                <div class="translate transform overflow-hidden" :class="selected === 'Task' ? 'block' : 'hidden'">
                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                        class="menu-dropdown mt-2 flex flex-col gap-1 pl-9">
                        <li>
                            <a href="{{ route('admin.sale.index') }}"
                                class="menu-dropdown-item group {{ request()->routeIs('admin.sale.index') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                                Data Penjualan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.stock.index') }}"
                                class="menu-dropdown-item group {{ request()->routeIs('admin.stock.index') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}">
                                Data Barang Masuk
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Other</span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" />
                    </svg>
                </h3>
                <ul class="flex flex-col gap-y-5">
                    <li>
                        <a href="{{ route('admin.packaging.index') }}"
                            class="menu-item group {{ request()->routeIs('admin.packaging*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="far fa-box-alt fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kelola Kemasan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.index') }}"
                            class="menu-item group {{ request()->routeIs('admin.category*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <i class="fal fa-list fa-lg"></i>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kelola Kategori</span>
                        </a>
                    </li>
                </ul>
            </div>


        </nav>
    </div>
</aside>