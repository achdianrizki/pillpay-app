<div x-data="{ isModalOpen: false, deleteUrl: '' }" x-on:open-modal.window="isModalOpen = true; deleteUrl = $event.detail.url">
    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50" @click="isModalOpen = false"></div>

        <!-- Modal Box -->
        <div class="flex flex-col px-4 py-4 overflow-y-auto no-scrollbar">
            <div @click.outside="isModalOpen = false"
                class="relative w-full max-w-[507px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
                <div class="text-center">
                    <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90 sm:text-title-sm">
                        Apakah anda yakin ingin menghapus data ini?
                    </h4>
                    <div class="flex items-center justify-center w-full gap-3 mt-8">
                        <button @click="isModalOpen = false" type="button"
                            class="flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            Batal
                        </button>
                        <form :action="deleteUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-error-500 shadow-theme-xs hover:bg-error-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
