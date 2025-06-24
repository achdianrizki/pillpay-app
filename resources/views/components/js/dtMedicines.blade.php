<script>
    function dataTableThree() {
        return {
            search: "",
            sortColumn: "created_at",
            sortDirection: "desc",
            currentPage: 1,
            perPage: 10,
            data: [],
            selectedItems: [],
            isModalOpen: false,
            supplierName: '',
            minDate: '',
            supplierError: '',
            itemErrors: [],

            submitForm() {
                this.supplerError = '';

                if (!this.supplierName) {
                    this.supplierError = 'Nama supplier wajib diisi.';
                    return;
                }

                if (this.selectedItems.length === 0) {
                    this.supplierError = 'Pilih setidaknya satu item obat.';
                    return;
                }

                this.itemErrors = this.selectedItems.map(() => ({
                    jumlah_stok: '',
                    purchase_price: '',
                    packaging: '',
                    expiration_date: ''
                }));

                let hasError = false;

                this.selectedItems.forEach((item, index) => {
                    if (!item.jumlah_stok) {
                        this.itemErrors[index].jumlah_stok = 'Jumlah stok wajib diisi.';
                        hasError = true;
                    }
                    if (!item.purchase_price) {
                        this.itemErrors[index].purchase_price = 'Harga beli wajib diisi.';
                        hasError = true;
                    }
                    if (!item.packaging) {
                        this.itemErrors[index].packaging = 'Kemasan wajib dipilih.';
                        hasError = true;
                    }
                    if (!item.expiration_date) {
                        this.itemErrors[index].expiration_date = 'Tanggal expire wajib diisi.';
                        hasError = true;
                    }
                });

                if (!this.supplierName) {
                    this.supplierError = 'Nama supplier wajib diisi.';
                    hasError = true;
                }

                if (hasError) return;



                const payload = {
                    supplier: this.supplierName,
                    entries: this.selectedItems.map(item => ({
                        medicine_id: item.id,
                        quantity: item.jumlah_stok,
                        expiration_date: item.expiration_date,
                        purchase_price: item.purchase_price,
                        packaging: item.packaging,
                    })),

                };

                fetch('/api/stock-entries', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(async (res) => {
                        if (!res.ok) {
                            const error = new Error('Gagal submit data');
                            error.response = res;
                            throw error;
                        }
                        return res.json();
                    })
                    .then(data => {
                        window.notyf?.success('Stok berhasil ditambahkan.');
                        this.selectedItems = [];
                        this.supplierName = '';
                        this.isModalOpen = false;
                        this.fetchData();
                    })
                    .catch(async (error) => {
                        if (error.response) {
                            const errData = await error.response.json();
                            console.error("Error response:", errData);
                            let message = errData.message || 'Terjadi kesalahan.';
                            if (errData.errors) {
                                message += '\n' + Object.values(errData.errors).flat().join('\n');
                            }
                            alert(message);
                        } else {
                            console.error("Unexpected error:", error);
                            alert('Terjadi kesalahan saat menyimpan: ' + error.message);
                        }
                    });
            },

            async fetchData() {
                try {
                    const response = await fetch('/api/medicine/data');
                    const result = await response.json();
                    this.data = result;
                } catch (error) {
                    console.error("Failed to fetch data:", error);
                }
            },

            init() {
                const today = new Date();
                today.setDate(today.getDate() + 1);
                this.minDate = today.toISOString().split('T')[0];
                this.fetchData();
            },

            get pagesAroundCurrent() {
                let pages = [];
                const startPage = Math.max(2, this.currentPage - 2);
                const endPage = Math.min(this.totalPages - 1, this.currentPage + 2);
                for (let i = startPage; i <= endPage; i++) {
                    pages.push(i);
                }
                return pages;
            },

            get filteredData() {
                const searchLower = this.search.toLowerCase();
                return this.data
                    .filter(
                        (product) =>
                        product.name.toLowerCase().includes(searchLower) ||
                        product.standard_name.toLowerCase().includes(searchLower) ||
                        product.code.toLowerCase().includes(searchLower),
                    )
                    .sort((a, b) => {
                        let modifier = this.sortDirection === "asc" ? 1 : -1;
                        if (a[this.sortColumn] < b[this.sortColumn]) return -1 * modifier;
                        if (a[this.sortColumn] > b[this.sortColumn]) return 1 * modifier;
                        return 0;
                    });
            },

            get paginatedData() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.filteredData.slice(start, end);
            },

            get totalEntries() {
                return this.filteredData.length;
            },

            get startEntry() {
                return (this.currentPage - 1) * this.perPage + 1;
            },

            get endEntry() {
                const end = this.currentPage * this.perPage;
                return end > this.totalEntries ? this.totalEntries : end;
            },

            get totalPages() {
                return Math.ceil(this.filteredData.length / this.perPage);
            },

            goToPage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                }
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                }
            },

            sortBy(column) {
                if (this.sortColumn === column) {
                    this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
                } else {
                    this.sortDirection = "asc";
                    this.sortColumn = column;
                }
            },
        };
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2,
            currency: 'IDR'
        }).format(number);
    }
</script>
