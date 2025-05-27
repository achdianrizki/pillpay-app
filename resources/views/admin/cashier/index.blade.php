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
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- ====== Table Six Start -->
                <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span
                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">No</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span
                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">Nama kasir</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span
                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">Shift</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span
                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">Jumlah Transaksi</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span
                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">Total Penjualan</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span
                                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">Status</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->
                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr>
                                <td class="px-5 py-4 sm:px-6">1</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Hirzan</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Pagi</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">120</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Rp 12.000.000</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span class="bg-success-500 text-white text-xs font-medium px-2 py-0.5 rounded">
                                        Online
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-4 sm:px-6">2</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Raddit</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Siang</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">95</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Rp 9.500.000</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span class="bg-warning-500 text-white text-xs font-medium px-2 py-0.5 rounded">
                                        Offline
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-4 sm:px-6">3</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Rizal</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Malam</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">70</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">Rp 7.000.000</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span class="bg-success-500 text-white text-xs font-medium px-2 py-0.5 rounded">
                                        Online
                                    </span>
                                </td>
                            </tr>
                            <!-- Tambahkan baris data kasir lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>



                </div>
                <!-- ====== Table Six End -->
            </div>
        </div>
    </div>
</x-layout>
