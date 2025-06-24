 <div class="bg-gray-100 p-4 md:p-2 rounded shadow" data-id="{{ $product->id }}" data-kategori="{{ $product->category_name }}"
     data-harga="{{ $product->selling_price }}" data-stock="{{ $product->stock }}">
    <img src="{{ asset('storage/product/' . $product->images) }}" alt="{{ $product->name }}"
        class="w-full h-48 md:h-56 lg:h-48 object-cover rounded mb-2">
     <h3 class="text-lg md:text-md font-semibold mb-1">{{ $product->name }}</h3>
    <h4 class="text-xs md:text-sm lg:text-base font-medium mb-1">
        <div class="flex flex-col sm:flex-row sm:justify-between">
            <div>
                {{ 'Rp ' . number_format($product->selling_price, 0, ',', '.') }}
                <span class="text-xs md:text-sm">/<small>{{ $product->packaging_name }}</small></span>
            </div>
            <div class="mt-1 sm:mt-0">
                <small>Stock:</small> <span class="text-xs md:text-sm">{{ $product->stock }}</span>
            </div>
        </div>
    </h4>
     <p class="text-gray-600 mb-2 text-sm">{{ Str::limit($product->description, 20, '...') }}</p>
     <div class="flex justify-between products-center space-x-2">
        @if($product->stock == 0)
            <button class="h-auto w-32 bg-gray-200 text-white px-2 py-1 rounded cursor-not-allowed" disabled>
                Habis
            </button>
        @else
            <button x-data="" class="tambah-barang h-auto w-32 bg-blue-500 text-white px-2 py-1 rounded"
                data-nama="{{ $product->name }}">
                Tambah <i class="far fa-plus-circle"></i>
            </button>
        @endif
         <button x-data x-on:click="$dispatch('open-modal', 'detail-modal-{{ $product->id }}')">
             <i class="far fa-exclamation-circle"></i>
         </button>

         <!-- Detail Modal -->
         <x-modal name="detail-modal-{{ $product->id }}" :show="false" maxWidth="sm">
             <div class="p-6">
                 <h2 class="text-lg font-medium text-gray-900 mb-2">{{ $product->name }}</h2>
                 <div class="space-y-1">
                     <h5>Deskripsi</h5>
                     <p class="text-gray-600 my-2">{{ $product->description }}</p>
                 </div>
                 <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                 <div class="space-y-1">
                     <h5>Aturan Pakai</h5>
                     <p class="text-gray-600 my-2">{{ $product->usage_instruction }}</p>
                 </div>
                 <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
                     x-on:click="$dispatch('close-modal', 'detail-modal-{{ $product->id }}')">Tutup</button>
             </div>
         </x-modal>
     </div>
 </div>
