<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: `Data Penjualan` }">
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
        <div class="rounded-2xl border border-gray-200 bg-white">
            <div class="p-5 border-t border-gray-100 sm:p-6">
                <div class="max-w-full overflow-x-auto">
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
                                        <p class="font-medium text-gray-500 text-theme-xs">Kasir</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Total Price</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Change</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Payment Method</p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs">Entry Date</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($sales as $item)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">{{ $sales->firstItem() + $loop->index }}</td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->user->name }}</td>
                                    <td class="px-5 py-4 sm:px-6">
                                        Rp. {{ number_format($item->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        Rp. {{ number_format($item->change, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->payment_method }}</td>
                                    <td class="px-5 py-4 sm:px-6">{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.sale.show', $item->id) }}"
                                            class="text-white p-2 rounded-lg hover:bg-brand-100 bg-brand-500">Show</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data penjualan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">
                        @if ($sales->hasPages())
                            <nav class="inline-flex items-center -space-x-px text-sm gap-1 ">
                                @if ($sales->onFirstPage())
                                    <span
                                        class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md">Prev</span>
                                @else
                                    <a href="{{ $sales->previousPageUrl() }}"
                                        class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-200 rounded-l-md">Prev</a>
                                @endif

                                @foreach ($sales->getUrlRange(1, $sales->lastPage()) as $page => $url)
                                    @if ($page == $sales->currentPage())
                                        <span
                                            class="px-3 py-2 text-white bg-brand-500 border border-brand-500">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($sales->hasMorePages())
                                    <a href="{{ $sales->nextPageUrl() }}"
                                        class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-200 rounded-r-md">Next</a>
                                @else
                                    <span
                                        class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-r-md">Next</span>
                                @endif
                            </nav>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
