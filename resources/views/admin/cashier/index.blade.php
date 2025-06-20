<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Kasir` }">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500" href="index.html">
                            Home
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800" x-text="pageName"></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <div class="space-y-5 sm:space-y-6">
        <div class="space-y-5 sm:space-y-6">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.cashier.create') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    Tambah Kasir
                </a>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white">
                <div class="p-5 border-t border-gray-100 sm:p-6">
                    @if (session('success'))
                    <div class="text-green-600">{{ session('success') }}</div>
                    @endif
                    <!-- ====== Table Six Start -->
                    
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-100 text-left">
                                    <th class="px-5 py-3 sm:px-6">No</th>
                                    <th class="px-5 py-3 sm:px-6">Foto</th>
                                    <th class="px-5 py-3 sm:px-6">Nama kasir</th>
                                    <th class="px-5 py-3 sm:px-6">Shift</th>
                                    <th class="px-5 py-3 sm:px-6">Status</th>
                                    <th class="px-5 py-3 sm:px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($cashiers as $index => $cashier)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">{{ $index + 1 }}</td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <img class="mr-3 w-11 h-11 rounded-full object-cover object-bottom"
                                            src="{{ asset('storage/user/' . $cashier->images) }}" alt="User" />
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">{{ $cashier->name }}</td>
                                    <td class="px-5 py-4 sm:px-6">{{ $cashier->shift }}</td>
                                    <td class="px-5 py-4 sm:px-6">
                                        @if ($cashier->status == 'online')
                                        <span
                                            class="bg-success-500 text-white text-xs font-medium px-2 py-0.5 rounded">Online</span>
                                        @else
                                        <span
                                            class="bg-warning-500 text-white text-xs font-medium px-2 py-0.5 rounded">Offline</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open"
                                                class="text-gray-500 dark:text-gray-400 focus:outline-none">
                                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.999 10.245c.967 0 1.75.783 1.75 1.75v.01c0 .967-.783 1.75-1.75 1.75-.966 0-1.75-.783-1.75-1.75v-.01c0-.967.784-1.75 1.75-1.75zm12 0c.967 0 1.75.783 1.75 1.75v.01c0 .967-.783 1.75-1.75 1.75-.966 0-1.75-.783-1.75-1.75v-.01c0-.967.784-1.75 1.75-1.75zM13.749 11.995c0-.967-.784-1.75-1.75-1.75-.967 0-1.75.783-1.75 1.75v.01c0 .967.783 1.75 1.75 1.75.966 0 1.75-.783 1.75-1.75v-.01z" />
                                                </svg>
                                            </button>
                                            <div x-show="open" @click.outside="open = false"
                                                class="absolute z-10 mt-2 w-32 rounded-lg bg-white border border-gray-200 shadow-lg dark:bg-gray-800 dark:border-gray-700"
                                                x-transition>
                                                <a href="{{ route('admin.cashier.edit', $cashier->id) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Edit</a>
                                                <form action="{{ route('admin.cashier.destroy', $cashier->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus kasir ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    
                    <!-- ====== Table Six End -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
