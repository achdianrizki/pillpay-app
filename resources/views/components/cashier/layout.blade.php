<!doctype html>
<html lang="en">

<body class=" h-screen">
    <x-cashier.head></x-cashier.head>

    <div class="relative flex flex-col flex-1 overflow-x-hidden">
        <!-- ===== Page Wrapper Start ===== -->
        <x-cashier.header></x-cashier.header>

        <main class="flex-1 overflow-hidden h-[calc(100vh-64px)]">
            <div class="h-full md:p-6 bg-gray-100">
                {{ $slot }}
            </div>
        </main>

    </div>

    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('fontawesome/pro.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('tailadmin/build/bundle.js') }}"></script>
    @stack('scripts')
</body>

</html>
