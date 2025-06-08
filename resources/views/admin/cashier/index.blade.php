<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `List Kasir` }">
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
                    <li class="text-sm text-gray-800" x-text="pageName"></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.cashier.create') }}"
                class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                Tambah Kasir Baru +
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
                                        <span class="block font-medium text-gray-800 text-theme-sm">Nama kasir</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Shift</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Jumlah
                                            Transaksi</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Total
                                            Penjualan</span>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <span class="block font-medium text-gray-800 text-theme-sm">Status</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->

                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="px-5 py-4 sm:px-6">1</td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Hirzan</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Pagi</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">120</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Rp 12.000.000</p>
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
                                    <p class="text-gray-500 text-theme-sm">Raddit</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Siang</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">95</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Rp 9.500.000</p>
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
                                    <p class="text-gray-500 text-theme-sm">Rizal</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Malam</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">70</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm">Rp 7.000.000</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span class="bg-success-500 text-white text-xs font-medium px-2 py-0.5 rounded">
                                        Online
                                    </span>
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
</x-app-layout>
