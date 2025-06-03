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
                                <th class="px-5 py-3 sm:px-6">No</th>
                                <th class="px-5 py-3 sm:px-6">Nama kasir</th>
                                <th class="px-5 py-3 sm:px-6">Shift</th>
                                <th class="px-5 py-3 sm:px-6">Jumlah Transaksi</th>
                                <th class="px-5 py-3 sm:px-6">Total Penjualan</th>
                                <th class="px-5 py-3 sm:px-6">Status</th>
                                <th class="px-5 py-3 sm:px-6 text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <!-- table header end -->

                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr>
                                <td class="px-5 py-4 sm:px-6">1</td>
                                <td class="px-5 py-4 sm:px-6">Hirzan</td>
                                <td class="px-5 py-4 sm:px-6">Pagi</td>
                                <td class="px-5 py-4 sm:px-6">120</td>
                                <td class="px-5 py-4 sm:px-6">Rp 12.000.000</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span
                                        class="bg-success-500 text-white text-xs font-medium px-2 py-0.5 rounded">Online</span>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-blue-600 hover:underline">Edit</button>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-4 sm:px-6">2</td>
                                <td class="px-5 py-4 sm:px-6">Raddit</td>
                                <td class="px-5 py-4 sm:px-6">Siang</td>
                                <td class="px-5 py-4 sm:px-6">95</td>
                                <td class="px-5 py-4 sm:px-6">Rp 9.500.000</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span
                                        class="bg-warning-500 text-white text-xs font-medium px-2 py-0.5 rounded">Offline</span>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-blue-600 hover:underline">Edit</button>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <button class="text-sm text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-4 sm:px-6">3</td>
                                <td class="px-5 py-4 sm:px-6">Rizal</td>
                                <td class="px-5 py-4 sm:px-6">Malam</td>
                                <td class="px-5 py-4 sm:px-6">70</td>
                                <td class="px-5 py-4 sm:px-6">Rp 7.000.000</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span
                                        class="bg-success-500 text-white text-xs font-medium px-2 py-0.5 rounded">Online</span>
                                </td>
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
</x-layout>
