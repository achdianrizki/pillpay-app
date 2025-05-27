<!doctype html>
<html lang="en">

<x-head></x-head>

<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">
    <!-- ===== Preloader Start ===== -->
    <x-preloader></x-preloader>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <x-sidebar></x-sidebar>
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Small Device Overlay Start -->
            <x-overlay></x-overlay>
            <!-- Small Device Overlay End -->

            <!-- ===== Header Start ===== -->
            <x-header></x-header>
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                {{-- <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        <div class="col-span-12 space-y-6 xl:col-span-7">
                            <!-- Metric Group One -->
                            <include src="./partials/metric-group/metric-group-01.html" />
                            <!-- Metric Group One -->

                            <!-- ====== Chart One Start -->
                            <include src="./partials/chart/chart-01.html" />
                            <!-- ====== Chart One End -->
                        </div>
                        <div class="col-span-12 xl:col-span-5">
                            <!-- ====== Chart Two Start -->
                            <include src="./partials/chart/chart-02.html" />
                            <!-- ====== Chart Two End -->
                        </div>

                        <div class="col-span-12">
                            <!-- ====== Chart Three Start -->
                            <include src="./partials/chart/chart-03.html" />
                            <!-- ====== Chart Three End -->
                        </div>

                        <div class="col-span-12 xl:col-span-5">
                            <!-- ====== Map One Start -->
                            <include src="./partials/map-01.html" />
                            <!-- ====== Map One End -->
                        </div>

                        <div class="col-span-12 xl:col-span-7">
                            <!-- ====== Table One Start -->
                            <include src="./partials/table/table-01.html" />
                            <!-- ====== Table One End -->
                        </div>
                    </div>
                </div> --}}
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
</body>

</html>