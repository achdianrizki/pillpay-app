<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Transaksi</h2>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">ID Transaksi:</span>
            <span class="ml-2 text-gray-900">{{ $sale_detail->first()->sale_id ?? '-' }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b text-left text-gray-700">No</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Produk</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Jumlah</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Harga Unit</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Subtotal</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Kembalian</th>
                        <th class="px-4 py-2 border-b text-left text-gray-700">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sale_detail as $i => $detail)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $detail->medicine->name ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $detail->quantity }}</td>
                            <td class="px-4 py-2 border-b">Rp{{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">
                                Rp{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">
                                Rp{{ number_format($detail->change, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">
                                {{ $detail->created_at ? $detail->created_at->format('d-m-Y H:i') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada detail transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.sale.index') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kembali</a>
        </div>
    </div>
</x-app-layout>
