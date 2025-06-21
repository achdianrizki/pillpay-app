<x-app-layout>
    <!-- Breadcrumb Start -->
    <div x-data="{ pageName: 'List Obat' }">
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
                    <li class="text-sm text-gray-800" x-text="pageName"></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">

        <div x-data="dataTableThree()">
            <div class="flex items-center justify-between py-2">
                {{-- <div x-text="JSON.stringify(selectedItems)"></div> --}}
                <button @click="isModalOpen = !isModalOpen" :disabled="selectedItems.length === 0"
                    :class="{ 'bg-brand-500 hover:bg-brand-600 cursor-pointer': selectedItems.length > 0, 'bg-gray-300 cursor-not-allowed': selectedItems.length === 0}"
                    class="px-3 py-2 text-sm font-medium text-white rounded-lg shadow-theme-xs">
                    Tambah Stok
                </button>

                <div x-show="isModalOpen"
                    class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999">
                    <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50"></div>
                    <div @click.outside="isModalOpen = false"
                        class="relative w-full max-w-[700px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
                        <!-- close btn -->
                        <button @click="isModalOpen = false" class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center
                            rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 hover:text-gray-500
                            dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11">
                            <i class="far fa-times"></i>
                        </button>

                        <form @submit.prevent="submitForm()">
                            @csrf
                            <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                                Tambah Stok Obat
                            </h4>

                            <!-- Nama Supplier -->
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Nama Supplier
                                </label>
                                <input type="text" x-model="supplierName" placeholder="Nama Supplier"
                                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                            </div>

                            <!-- Daftar Obat Terpilih -->
                            <div class="max-h-[195px] overflow-y-auto">
                                <template x-for="(item, index) in selectedItems" :key="item.id">
                                    {{-- <div x-init="console.log('Selected item:', item.id)"> --}}
                                        <div class="mb-4 grid grid-cols-3 gap-4">
                                            <div>
                                                <label
                                                    class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Nama Obat
                                                </label>
                                                <input type="text" x-model="item.name" readonly
                                                    class="h-11 w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-2.5 text-sm text-gray-800 dark:bg-gray-800 dark:text-white/90" />
                                            </div>

                                            <div>
                                                <label
                                                    class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Jumlah Stok
                                                </label>
                                                <input type="number" x-model="item.jumlah_stok"
                                                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                                            </div>

                                            <div>
                                                <label
                                                    class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Tanggal Expire
                                                </label>
                                                <input type="date" x-model="item.expiration_date" :min="minDate"
                                                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                                    onclick="this.showPicker()" />
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>


                            <div class="flex items-center justify-end w-full gap-3 mt-6">
                                <button type="button" @click="isModalOpen = false"
                                    class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
                                    Close
                                </button>
                                <button type="button" @click="submitForm()"
                                    class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                                    Simpan
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
                <a href="{{ route('admin.medicine.create') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    Tambah Obat Baru +
                </a>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white sm:p-6">
                <!-- DataTable Three -->
                <div class="overflow-hidden rounded-xl bg-white pt-4">
                    <div class="mb-4 flex flex-col gap-2 px-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-gray-500 dark:text-gray-400"> Show </span>
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select
                                    class="dark:bg-dark-900 h-9 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none py-2 pl-3 pr-8 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                    :class="isOptionSelected ? 'text-gray-800' : 'text-gray-500 dark:text-gray-400'"
                                    @change="isOptionSelected = true" @change="perPage = $event.target.value">
                                    <option value="10" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                        10
                                    </option>
                                    <option value="8" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                        8
                                    </option>
                                    <option value="5" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                        5
                                    </option>
                                </select>
                                <span
                                    class="absolute right-2 top-1/2 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <i class="far fa-chevron-down"></i>
                                </span>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400"> entries </span>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <div class="relative">
                                <button
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <i class="far fa-search"></i>
                                </button>

                                <input type="text" x-model="search" placeholder="Search..."
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-11 pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[300px]" />
                            </div>

                            <button
                                class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-[11px] text-sm font-medium text-gray-700 shadow-theme-xs dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 sm:w-auto">
                                Download

                                <i class="fas fa-arrow-to-bottom"></i>
                            </button>
                        </div>
                    </div>

                    <div class="max-w-full overflow-x-auto">
                        <div class="min-w-[1102px]">
                            <!-- table header start -->
                            <div class="grid grid-cols-12 border-t border-gray-200 dark:border-gray-800">
                                <div
                                    class="col-span-2 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('name')">
                                        <div class="flex items-center gap-3">
                                            <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                                Name
                                            </p>
                                        </div>

                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-1 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('code')">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Code
                                        </p>
                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-2 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('selling_price')">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Selling Price
                                        </p>
                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-2 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('purchase_price')">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Purchase Price
                                        </p>
                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-1 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('stock')">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Stock
                                        </p>
                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-1 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('expiration_date')">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Expiration Date
                                        </p>
                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-2 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full cursor-pointer items-center justify-between"
                                        @click="sortBy('drug_class')">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Drug Class
                                        </p>
                                        <span class="flex flex-col gap-0.5">
                                            <i class="fal fa-sort"></i>
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-span-1 flex items-center border-r border-gray-200 px-4 py-3 dark:border-gray-800">
                                    <div class="flex w-full items-center justify-between">
                                        <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                            Action
                                        </p>
                                        <div class="flex gap-2">
                                            <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                                <i class="fal fa-pen fa-sm"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700" title="Delete">
                                                <i class="fal fa-trash fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- table header end -->

                            <!-- table body start -->
                            <template x-for="product in paginatedData" :key="product.id">
                                <!-- table item -->
                                <div x-data="{ checkboxToggle: false }"
                                    class="grid grid-cols-12 border-t border-gray-100 dark:border-gray-800"
                                    :class="checkboxToggle ? 'bg-gray-50 dark:bg-gray-900' : ''">
                                    <div
                                        class="col-span-2 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <div class="flex gap-3">
                                            <div class="mt-1">
                                                <label
                                                    class="flex cursor-pointer select-none items-center text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    <span class="relative">
                                                        <input type="checkbox" :value="product.id"
                                                            class="border-gray-200 rounded-sm focus:outline-none focus:ring-0"
                                                            :checked="selectedItems.findIndex(i => i.id === product.id) !== -1"
                                                            @change="
                                                                const index = selectedItems.findIndex(i => i.id === product.id);
                                                            if (index !== -1) {
                                                                selectedItems.splice(index, 1);
                                                            } else {
                                                                selectedItems.push({
                                                                    id: product.id,
                                                                    name: product.name
                                                                });
                                                            }
                                                        ">
                                                    </span>
                                                </label>
                                            </div>

                                            <div>
                                                <p class="block text-theme-sm font-medium text-gray-800 dark:text-white/90"
                                                    x-text="product.name"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-span-1 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="product.code">
                                        </p>
                                    </div>
                                    <div
                                        class="col-span-2 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <div class="flex justify-start">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400">Rp. </p>
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400"
                                                x-text="formatRupiah(product.selling_price)"></p>/
                                            <p class="text-theme-xs ml-2 text-gray-700 dark:text-gray-400"
                                                x-text="product.packaging.name"></p>

                                        </div>
                                    </div>
                                    <div
                                        class="col-span-2 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">Rp. </p>
                                        <p class="text-theme-sm text-gray-700 dark:text-gray-400"
                                            x-text="formatRupiah(product.purchase_price)"></p>/
                                        <p class="text-theme-xs ml-2 text-gray-700 dark:text-gray-400"
                                            x-text="product.packaging.name"></p>

                                    </div>
                                    <div
                                        class="col-span-1 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <p class="text-theme-sm text-gray-700 dark:text-gray-400"
                                            x-text="product.stock">
                                        </p>
                                    </div>
                                    <div
                                        class="col-span-1 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <p class="text-theme-sm text-gray-700 dark:text-gray-400"
                                            x-text="product.expiration_date"></p>
                                    </div>
                                    <div
                                        class="col-span-2 flex items-center border-r border-gray-100 px-4 py-3 dark:border-gray-800">
                                        <p :class="{
                                            'bg-success-50 text-success-700': product.drug_class === 'Over-the-counter',
                                            'bg-brand-50 text-brand-700': product.drug_class === 'Limited OTC',
                                            'bg-error-50 text-error-700': product.drug_class === 'Prescription'
                                        }" class="rounded-full px-2 py-0.5 text-theme-xs font-medium"
                                            x-text="product.drug_class"></p>
                                    </div>
                                    <div class="col-span-1 flex items-center px-4 py-3">
                                        <div class="flex w-full items-center gap-5">
                                            <form :action="`/admin/medicine/${product.id}`" method="POST" @submit.prevent="if(confirm('Yakin ingin menghapus obat ini?')) $el.submit()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-error-500 dark:text-gray-400 dark:hover:text-error-500" title="Delete">
                                                    <i class="fal fa-trash fa-lg"></i>
                                                </button>
                                            </form>
                                            <a :href="`/admin/medicine/${product.id}/edit`"
                                                class="text-warning-500 dark:text-gray-400 dark:hover:text-white/90">
                                                <i class="fal fa-pen fa-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <!-- table body end -->
                        </div>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="border-t border-gray-100 py-4 pl-[18px] pr-4 dark:border-gray-800">
                        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between">
                            <p
                                class="border-b border-gray-100 pb-3 text-center text-sm font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400 xl:border-b-0 xl:pb-0 xl:text-left">
                                Showing <span x-text="startEntry"></span> to
                                <span x-text="endEntry"></span> of
                                <span x-text="totalEntries"></span> entries
                            </p>
                            <div class="flex items-center justify-center gap-0.5 pt-3 xl:justify-end xl:pt-0">
                                <button @click="prevPage()"
                                    class="mr-2.5 flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-gray-700 shadow-theme-xs hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                                    :disabled="currentPage === 1">
                                    Previous
                                </button>

                                <button @click="goToPage(1)" :class="currentPage === 1 ? 'bg-blue-500/[0.08] text-brand-500' :
                                        'text-gray-700 dark:text-gray-400'"
                                    class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500">
                                    1
                                </button>

                                <template x-if="currentPage > 3">
                                    <span
                                        class="flex h-10 w-10 items-center justify-center rounded-lg hover:bg-blue-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500">...</span>
                                </template>

                                <template x-for="page in pagesAroundCurrent" :key="page">
                                    <button @click="goToPage(page)" :class="currentPage === page ? 'bg-blue-500/[0.08] text-brand-500' :
                                            'text-gray-700 dark:text-gray-400'"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500">
                                        <span x-text="page"></span>
                                    </button>
                                </template>

                                <template x-if="currentPage < totalPages - 2">
                                    <span
                                        class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-500/[0.08] hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">...</span>
                                </template>

                                <button @click="nextPage()"
                                    class="ml-2.5 flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-gray-700 shadow-theme-xs hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                                    :disabled="currentPage === totalPages">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DataTable Three -->
        </div>
    </div>

    @push('scripts')
    @include('components.js.dtMedicines')
    @endpush
    </x-app->