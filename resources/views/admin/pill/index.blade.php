<x-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `Basic Tables` }">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="index.html">
                            Home
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <button id="openModal"
            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
            Open Modal
        </button>
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- ====== Table Six Start -->
                <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 sm:px-6">No</th>
                                <th class="px-5 py-3 sm:px-6">Nama obat</th>
                                <th class="px-5 py-3 sm:px-6">Kategori</th>
                                <th class="px-5 py-3 sm:px-6">Stok</th>
                                <th class="px-5 py-3 sm:px-6">Harga</th>
                                <th class="px-5 py-3 sm:px-6">Status</th>
                                <th class="px-5 py-3 sm:px-6">Tanggal kadaluwarsa</th>
                                <th class="px-5 py-3 sm:px-6 text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <!-- table header end -->

                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr>
                                <td class="px-5 py-4 sm:px-6">1</td>
                                <td class="px-5 py-4 sm:px-6">Paracetamol</td>
                                <td class="px-5 py-4 sm:px-6">Analgesik</td>
                                <td class="px-5 py-4 sm:px-6">120</td>
                                <td class="px-5 py-4 sm:px-6">Rp 5.000</td>
                                <td class="px-5 py-4 sm:px-6">Tersedia</td>
                                <td class="px-5 py-4 sm:px-6">2026-12-31</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-blue-600 hover:underline">Edit</button>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-4 sm:px-6">2</td>
                                <td class="px-5 py-4 sm:px-6">Amoxicillin</td>
                                <td class="px-5 py-4 sm:px-6">Antibiotik</td>
                                <td class="px-5 py-4 sm:px-6">8</td>
                                <td class="px-5 py-4 sm:px-6">Rp 12.000</td>
                                <td class="px-5 py-4 sm:px-6">Hampir Habis</td>
                                <td class="px-5 py-4 sm:px-6">2025-10-15</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-blue-600 hover:underline">Edit</button>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-4 sm:px-6">3</td>
                                <td class="px-5 py-4 sm:px-6">Cetirizine</td>
                                <td class="px-5 py-4 sm:px-6">Antihistamin</td>
                                <td class="px-5 py-4 sm:px-6">0</td>
                                <td class="px-5 py-4 sm:px-6">Rp 7.500</td>
                                <td class="px-5 py-4 sm:px-6">Habis</td>
                                <td class="px-5 py-4 sm:px-6">2024-04-10</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-blue-600 hover:underline">Edit</button>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
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
            <h2 class="text-xl font-semibold mb-4">Modal Title</h2>
            <p class="mb-4">This is the content of the modal. You can place anything here.</p>
            <div class="flex justify-end space-x-2">
                <button id="closeModal" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Close
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Confirm
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
</x-layout>
