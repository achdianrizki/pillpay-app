<x-app-layout>


    <div x-data="{ pageName: `Edit Obat` }">
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
                            <option value="" disabled {{ old('category', $medicine->category) ? '' : 'selected' }}>Pilih
                                Kategori Obat
                            </option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category', $medicine->category_id) ==
                                $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
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
                                    <input id="over-the-counter" type="radio" value="Over-the-counter" name="drug_class"
                                        class="rounded-lg text-sm text-success-500 " x-model="drugClass" {{
                                        old('drug_class', $medicine->drug_class) == 'Over-the-counter' ? 'checked' : ''
                                    }}>
                                    <label for="over-the-counter" class="w-full ms-2 text-sm font-medium text-gray-900">
                                        Over the counter
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border p-3 rounded-lg"
                                :class="drugClass === 'Limited OTC' ? 'border-brand-500' : 'border-gray-200'">
                                <div class="flex items-center ps-3 gap-3">
                                    <input id="Limited-OTC" type="radio" value="Limited OTC" name="drug_class"
                                        class="rounded-lg text-sm text-brand-800 " x-model="drugClass" {{
                                        old('drug_class', $medicine->drug_class) == 'Limited OTC' ? 'checked' : '' }}>
                                    <label for="Limited-OTC" class="w-full ms-2 text-sm font-medium text-gray-900">
                                        Limited OTC
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border p-3 rounded-lg"
                                :class="drugClass === 'Prescription' ? 'border-error-500' : 'border-gray-200'">
                                <div class="flex items-center ps-3 gap-3">
                                    <input id="Prescription" type="radio" value="Prescription" name="drug_class"
                                        class="rounded-lg text-sm text-error-500 " x-model="drugClass" {{
                                        old('drug_class', $medicine->drug_class) == 'Prescription' ? 'checked' : '' }}>
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
                        <div x-data="{ isOptionSelected: {{ old('packaging', $medicine->packaging) ? 'true' : 'false' }} }"
                            class="relative z-20 bg-transparent">
                            <select
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                @change="isOptionSelected = true" name="packaging" id="packaging">
                                <option value="" disabled {{ old('packaging', $medicine->packaging) ? '' : 'selected'
                                    }}>Pilih
                                    Kategori Obat
                                </option>
                                @foreach ($packagings as $packaging)
                                <option value="{{ $packaging->id }}" {{ old('packaging', $medicine->packaging_id) ==
                                    $packaging->id ? 'selected' : '' }}>
                                    {{ Str::ucfirst($packaging->name) }}
                                </option>
                                @endforeach
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
                        @error('packaging')
                        <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-span-6 md:col-span-2 space-y-3">

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