<x-app-layout>


    <div x-data="{ pageName: `Edit Obat` }">
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
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500"
                            href="{{ route('admin.medicine.index') }}">
                            List Obat
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

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-error-100 border border-error-400 text-error-700 px-4 py-3">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.medicine.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="rounded-2xl border border-gray-200 bg-white p-6 space-y-6 shadow-lg max-w-2xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                <div class="col-span-6 md:col-span-2 space-y-3">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Obat</label>
                        <input type="text" name="name" id="name" placeholder="Nama Obat"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                            value="{{ old('name', $medicine->name) }}">
                        @error('name')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="filter-kategori" name="category"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden">
                            <option value="" disabled
                                {{ old('category', $medicine->category) ? '' : 'selected' }}>Pilih Kategori Obat
                            </option>
                            <option value="Antipiretik"
                                {{ old('category', $medicine->category) == 'Antipiretik' ? 'selected' : '' }}>
                                Antipiretik
                            </option>
                            <option value="Antibiotik"
                                {{ old('category', $medicine->category) == 'Antibiotik' ? 'selected' : '' }}>
                                Antibiotik
                            </option>
                            <option value="Analgesik"
                                {{ old('category', $medicine->category) == 'Analgesik' ? 'selected' : '' }}>Analgesik
                            </option>
                            <option value="Antihistamin"
                                {{ old('category', $medicine->category) == 'Antihistamin' ? 'selected' : '' }}>
                                Antihistamin</option>
                            <option value="Antihipertensi"
                                {{ old('category', $medicine->category) == 'Antihipertensi' ? 'selected' : '' }}>
                                Antihipertensi</option>
                        </select>
                        @error('category')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="drug_class" class="block text-sm font-medium text-gray-700 mb-1">Kelas Obat</label>
                        <ul x-data="{ drugClass: '{{ old('drug_class', $medicine->drug_class) }}' }"
                            class="items-center flex flex-col md:flex-row justify-between w-full text-sm font-medium text-gray-900 sm:flex gap-2">
                            <li class="w-full border p-3 rounded-lg"
                                :class="drugClass === 'Over-the-counter' ? 'border-success-500' : 'border-gray-200'">
                                <div class="flex items-center ps-3 gap-3">
                                    <input id="over-the-counter" type="radio" value="Over-the-counter"
                                        name="drug_class" class="rounded-lg text-sm text-success-500 "
                                        x-model="drugClass"
                                        {{ old('drug_class', $medicine->drug_class) == 'Over-the-counter' ? 'checked' : '' }}>
                                    <label for="over-the-counter" class="w-full ms-2 text-sm font-medium text-gray-900">
                                        Over the counter
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border p-3 rounded-lg"
                                :class="drugClass === 'Limited OTC' ? 'border-brand-500' : 'border-gray-200'">
                                <div class="flex items-center ps-3 gap-3">
                                    <input id="Limited-OTC" type="radio" value="Limited OTC" name="drug_class"
                                        class="rounded-lg text-sm text-brand-800 " x-model="drugClass"
                                        {{ old('drug_class', $medicine->drug_class) == 'Limited OTC' ? 'checked' : '' }}>
                                    <label for="Limited-OTC" class="w-full ms-2 text-sm font-medium text-gray-900">
                                        Limited OTC
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border p-3 rounded-lg"
                                :class="drugClass === 'Prescription' ? 'border-error-500' : 'border-gray-200'">
                                <div class="flex items-center ps-3 gap-3">
                                    <input id="Prescription" type="radio" value="Prescription" name="drug_class"
                                        class="rounded-lg text-sm text-error-500 " x-model="drugClass"
                                        {{ old('drug_class', $medicine->drug_class) == 'Prescription' ? 'checked' : '' }}>
                                    <label for="Prescription" class="w-full ms-2 text-sm font-medium text-gray-900">
                                        Prescription
                                    </label>
                                </div>
                            </li>
                        </ul>
                        @error('drug_class')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-1">Harga
                            Jual</label>
                        <input type="number" name="selling_price" id="selling_price" placeholder="Harga Jual"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                            value="{{ old('selling_price', $medicine->selling_price) }}">
                        @error('selling_price')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Harga
                            Beli</label>
                        <input type="number" name="purchase_price" id="purchase_price" placeholder="Harga Beli"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                            value="{{ old('purchase_price', $medicine->purchase_price) }}">
                        @error('purchase_price')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="packaging" class="block text-sm font-medium text-gray-700 mb-1">Kemasan</label>
                        <div x-data="{ isOptionSelected: {{ old('packaging', $medicine->packaging) ? 'true' : 'false' }} }" class="relative z-20 bg-transparent">
                            <select
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                @change="isOptionSelected = true" name="packaging" id="packaging">
                                <option value="" disabled
                                    {{ old('packaging', $medicine->packaging) ? '' : 'selected' }}>Pilih Kemasan
                                </option>
                                <option value="Strip"
                                    {{ old('packaging', $medicine->packaging) == 'Strip' ? 'selected' : '' }}>Strip
                                </option>
                                <option value="Botol"
                                    {{ old('packaging', $medicine->packaging) == 'Botol' ? 'selected' : '' }}>Botol
                                </option>
                                <option value="Box"
                                    {{ old('packaging', $medicine->packaging) == 'Box' ? 'selected' : '' }}>Box (Dus)
                                </option>
                                <option value="Ampul"
                                    {{ old('packaging', $medicine->packaging) == 'Ampul' ? 'selected' : '' }}>Ampul
                                </option>
                                <option value="Tube"
                                    {{ old('packaging', $medicine->packaging) == 'Tube' ? 'selected' : '' }}>Tube
                                </option>
                            </select>
                            <span
                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                        @error('packaging')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-span-6 md:col-span-2 space-y-3">
                    <div>
                        <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Kadaluarsa</label>
                        <div class="relative">
                            <input type="date" name="expiration_date" id="expiration_date"
                                placeholder="Select date"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                onclick="this.showPicker()"
                                value="{{ old('expiration_date', $medicine->expiration_date ? \Illuminate\Support\Carbon::parse($medicine->expiration_date)->format('Y-m-d') : null) }}" />
                            <span
                                class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                        fill="" />
                                </svg>
                            </span>
                        </div>
                        @error('expiration_date')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="standard_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                            Standar <strong class="text-brand-500">(Opsional)</strong></label>
                        <input type="text" name="standard_name" id="standard_name" placeholder="Nama Standar"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                            value="{{ old('standard_name', $medicine->standard_name) }}">
                        @error('standard_name')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                            <strong class="text-brand-500">(Opsional)</strong></label>
                        <textarea name="description" id="description" placeholder="Deskripsi"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                            rows="3">{{ old('description', $medicine->description) }}</textarea>
                        @error('description')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="usage_instruction" class="block text-sm font-medium text-gray-700 mb-1">Aturan
                            Pakai</label>
                        <textarea name="usage_instruction" id="usage_instruction" placeholder="Aturan Pakai"
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden"
                            rows="3">{{ old('usage_instruction', $medicine->usage_instruction) }}</textarea>
                        @error('usage_instruction')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gambar Obat <strong
                                class="text-brand-500">(Opsional)</strong></label>
                        <input type="file" name="images" id="images" multiple
                            class="focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden bg-white">
                        @error('images')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                        @if ($medicine->images)
                            <div class="mt-2">
                                <span class="text-xs text-gray-500">Gambar saat ini:</span>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    <img src="{{ asset('storage/product/' . $medicine->images) }}" alt="Gambar Obat"
                                        class="h-16 rounded border">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-brand-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-brand-300 transition shadow">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
