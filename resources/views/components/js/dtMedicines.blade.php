<script>
    function dataTableThree() {
        return {
            search: "",
            sortColumn: "created_at",
            sortDirection: "desc",
            currentPage: 1,
            perPage: 10,
            data: [],

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
