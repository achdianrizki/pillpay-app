<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `Detail Data Barang Masuk` }">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500" href="{{ route('dashboard') }}">
                            Dashboard
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke=""
                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500"
                            href="{{ route('admin.stock.index') }}">
                            Data Barang Masuk
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke=""
                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
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
        <div class="rounded-2xl border border-gray-200 bg-white">
            <div class="p-5 border-t border-gray-100 sm:p-6">
                <div class="max-w-full">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">No</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Nama Obat</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Jumlah</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Harga Beli</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Tanggal Masuk</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Tanggal Expire</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Action</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($stock as $item)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->medicine->name }}</td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->quantity }}</td>
                                    <td class="px-5 py-4 sm:px-6">
                                        {{ 'Rp ' . number_format($item->purchase_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->entry_date }}</td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->expiration_date }}</td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open"
                                                class="text-gray-500 dark:text-gray-400 focus:outline-none">
                                                <svg class="fill-current" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.999 10.245c.967 0 1.75.783 1.75 1.75v.01c0 .967-.783 1.75-1.75 1.75-.966 0-1.75-.783-1.75-1.75v-.01c0-.967.784-1.75 1.75-1.75zm12 0c.967 0 1.75.783 1.75 1.75v.01c0 .967-.783 1.75-1.75 1.75-.966 0-1.75-.783-1.75-1.75v-.01c0-.967.784-1.75 1.75-1.75zM13.749 11.995c0-.967-.784-1.75-1.75-1.75-.967 0-1.75.783-1.75 1.75v.01c0 .967.783 1.75 1.75 1.75.966 0 1.75-.783 1.75-1.75v-.01z" />
                                                </svg>
                                            </button>
                                            <div x-show="open" @click.outside="open = false"
                                                class="absolute z-999999 mt-2 w-32 rounded-lg bg-white border border-gray-200 shadow-lg "
                                                x-transition>
                                                <a href="{{ route('admin.stock.edit', $item->id) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                                <button type="button"
                                                    @click="$dispatch('open-modal', { url: '{{ route('admin.stock.destroy', $item->id) }}' })"
                                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- ====== Table Six End -->
                <x-modal-delete />

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
