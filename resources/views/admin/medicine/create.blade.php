<x-app-layout>

    <div x-data="{ pageName: `Tambah Obat` }">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800" x-text="pageName"></h2>

            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500"
                            href="{{ route('dashboard') }}">
                            Dashboard
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500"
                            href="{{ route('admin.medicine.index') }}">
                            List Obat
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

    <form action="{{ route('admin.medicine.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="rounded-2xl border border-gray-200 bg-white p-8 space-y-6 shadow-lg max-w-2xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Obat</label>
                    <input type="text" name="name" id="name" placeholder="Nama Obat"
                        class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" name="category" id="category" placeholder="Kategori"
                        class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                </div>
                <div>
                    <label for="drug_class" class="block text-sm font-medium text-gray-700 mb-1">Kelas Obat</label>
                    <ul x-data="{ drugClass: '' }"
                        class="items-center flex justify-between w-full text-sm font-medium text-gray-900 sm:flex gap-2">
                        <li class="w-full border p-2"
                            :class="drugClass === 'Over-the-counter' ? 'border-brand-500' : 'border-gray-200'">
                            <div class="flex items-center ps-3">
                                <input id="over-the-counter" type="radio" value="Over-the-counter" name="drug_class"
                                    class="rounded-lg bg-transparent px-4 py-2.5 text-sm text-gray-800 w-10 h-4"
                                    x-model="drugClass">
                                <label for="over-the-counter" class="w-full ms-2 text-sm font-medium text-gray-900">
                                    Over the counter
                                </label>
                            </div>
                        </li>

                        <li class="w-full border p-2"
                            :class="drugClass === 'Limited OTC' ? 'border-brand-500' : 'border-gray-200'">
                            <div class="flex items-center ps-3">
                                <input id="Limited-OTC" type="radio" value="Limited OTC" name="drug_class"
                                    class="rounded-lg bg-transparent px-4 py-2.5 text-sm text-gray-800 w-10 h-4"
                                    x-model="drugClass">
                                <label for="Limited-OTC" class="w-full ms-2 text-sm font-medium text-gray-900">
                                    Limited OTC
                                </label>
                            </div>
                        </li>

                        <li class="w-full border p-2"
                            :class="drugClass === 'Prescription' ? 'border-brand-500' : 'border-gray-200'">
                            <div class="flex items-center ps-3">
                                <input id="Prescription" type="radio" value="Prescription" name="drug_class"
                                    class="rounded-lg bg-transparent px-4 py-2.5 text-sm text-gray-800 w-10 h-4"
                                    x-model="drugClass">
                                <label for="Prescription" class="w-full ms-2 text-sm font-medium text-gray-900">
                                    Prescription
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual</label>
                    <input type="number" name="selling_price" id="selling_price" placeholder="Harga Jual"
                        class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                </div>

                <div>
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Beli</label>
                    <input type="number" name="purchase_price" id="purchase_price" placeholder="Harga Beli"
                        class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                </div>
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stock" id="stock" placeholder="Stok"
                        class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                </div>
                <div>
                    <label for="packaging" class="block text-sm font-medium text-gray-700 mb-1">Kemasan</label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                            @change="isOptionSelected = true" name="packaging" id="packaging">
                            <option value="strip" selected disabled class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                Strip
                            </option>
                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                Botol
                            </option>
                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                Box (Dus)
                            </option>
                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                Kaplet/kapsul lepas satuan
                            </option>
                        </select>
                        <span
                            class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                        Kadaluarsa</label>
                    <div class="relative">
                      <input type="date" placeholder="Select date"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        onclick="this.showPicker()" />
                      <span
                        class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                            fill="" />
                        </svg>
                      </span>
                    </div>
                </div>
                <div>
                    <label for="standard_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Standar</label>
                    <input type="text" name="standard_name" id="standard_name" placeholder="Nama Standar"
                        class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" placeholder="Deskripsi"
                    class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                    rows="3"></textarea>
            </div>

            <div>
                <label for="usage_instruction" class="block text-sm font-medium text-gray-700 mb-1">Aturan Pakai</label>
                <textarea name="usage_instruction" id="usage_instruction" placeholder="Aturan Pakai"
                    class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                    rows="3"></textarea>
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gambar Obat</label>
                <input type="file" name="images[]" id="images" multiple
                    class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden bg-white">
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition shadow">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</x-app-layout>