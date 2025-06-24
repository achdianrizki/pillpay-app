<!-- CDN ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0"></script>


<script>
    function chartComponent(data) {
        return {
            chartInstance: null,

            init() {
                const el = document.querySelector("#saleChart");
                if (!el || !window.ApexCharts) return;

                if (this.chartInstance) this.chartInstance.destroy();

                const options = {
                    chart: {
                        type: 'bar',
                        height: 200,
                        toolbar: {
                            show: false
                        },
                        fontFamily: 'Outfit, sans-serif'
                    },
                    series: [{
                        name: 'Sales',
                        data: data
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ]
                    },
                    colors: ['#465fff'],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '39%',
                            borderRadius: 5,
                            borderRadiusApplication: "end"
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 4,
                        colors: ['transparent']
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: val => `Rp ${Number(val).toLocaleString()}`
                        }
                    }
                };

                this.chartInstance = new ApexCharts(el, options);
                this.chartInstance.render();
            }
        };
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('chartComponent', chartComponent);
    });
</script>

<!-- Inject data dari backend -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let el = document.querySelector("#saleChart");
        if (el) {
            el.setAttribute('x-data', `chartComponent(@json($monthlySales))`);
            el.setAttribute('x-init', 'init()');
        }
    });
</script>
