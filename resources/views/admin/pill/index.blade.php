<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Obat` }">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500" href="index.html">
                            Dashboard
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
        <div class="flex items-center justify-between">
            <button id="openModal"
                class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                Tambah Stok
            </button>
            <a href="{{ route('admin.pill.create') }}"
                class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                Tambah Obat Baru +
            </a>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white">
            <div class="p-5 border-t border-gray-100 sm:p-6">
                <!-- ====== Table Six Start -->
                <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">No</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Kode</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Nama Obat</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Kategori</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Stok</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Harga Jual</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Kemasan</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Tanggal Kadaluwarsa</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->

                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($pills as $item)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">{{ $item->code }}</p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">{{ $item->name }}</p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">{{ $item->category }}</p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">{{ $item->stock }}</p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">Rp {{ number_format($item->selling_price, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">{{ $item->packaging }}</p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm">{{ $item->expiration_date }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!-- table body end -->
                    </table>


                </div>
                <!-- ====== Table Six End -->
            </div>
        </div>
    </div>
    <!-- ====== Modal Start -->
    <div id="modalBackdrop" class="fixed inset-0 bg-gray-400/50 hidden items-center justify-center z-99999">
        <!-- Modal content -->
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
            <h2 class="text-xl font-semibold mb-4">Tambah Stok Obat</h2>
            <form>
                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Select Input
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                            :class="isOptionSelected && 'text-gray-800'" @change="isOptionSelected = true">
                            <option value="" class="text-gray-700">
                                Pilih Obat
                            </option>
                            <option value="" class="text-gray-700">
                                Paracetamol
                            </option>
                            <option value="" class="text-gray-700">
                                Amoxicillin
                            </option>
                            <option value="" class="text-gray-700">
                                Cetirizine
                            </option>
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Jumlah
                    </label>
                    <input type="text"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden" />
                </div>
            </form>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" id="closeModal"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50">
                    Tutup
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    Simpan
                </button>
            </div>
        </div>
    </div>
    <!-- ====== Modal End -->

    @push('scripts')
        <script>
            const openBtn = document.getElementById('openModal');
            const closeBtn = document.getElementById('closeModal');
            const modal = document.getElementById('modalBackdrop');

            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

            closeBtn.addEventListener('click', () => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            });

            // Optional: Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }
            });
        </script>
    @endpush
    </x-app->
