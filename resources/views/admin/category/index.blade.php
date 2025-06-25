<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Kategori` }">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500" href="index.html">
                            Dashboard
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
                <a href="{{ route('admin.category.create') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    Tambah Kategori
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
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">No</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Nama</p>
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
                            @forelse ($categories as $item)
                            <tr>
                                <td class="px-5 py-4 sm:px-6">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4 sm:px-6">{{ $item->name }}</td>
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
                                            <a href="{{ route('admin.category.edit', $item->id) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Edit</a>
                                            <button type="button"
                                                @click="open = false; $dispatch('open-modal', { id: {{ $item->id }} })"
                                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-5 py-4 sm:px-6 text-center text-gray-500">Tidak ada data
                                    kategori.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- ====== Table Six End -->
                </div>
            </div>
            <!-- Modal Konfirmasi Hapus -->
            <div x-data="{ isModalOpen: false, selectedId: null }"
                x-on:open-modal.window="isModalOpen = true; selectedId = $event.detail.id">
                <div x-show="isModalOpen"
                    class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999">
                    <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50"
                        @click="isModalOpen = false"></div>

                    <!-- Modal Box -->
                    <div class="flex flex-col px-4 py-4 overflow-y-auto no-scrollbar">
                        <div @click.outside="isModalOpen = false"
                            class="relative w-full max-w-[507px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
                            <div class="text-center">
                                <h4
                                    class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90 sm:text-title-sm">
                                    Apakah anda yakin ingin menghapus data category ini?
                                </h4>
                                <div class="flex items-center justify-center w-full gap-3 mt-8">
                                    <button @click="isModalOpen = false" type="button"
                                        class="flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        Batal
                                    </button>
                                    <form :action="`/admin/category/${selectedId}`" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-error-500 shadow-theme-xs hover:bg-error-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
