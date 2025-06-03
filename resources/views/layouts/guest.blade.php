<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        PillPay
    </title>
    <link rel="icon" href="{{ asset('tailadmin/build/favicon.ico') }}">
    {{-- <link href="{{ asset('tailadmin/build/style.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>


<body>

    <div class="relative p-6 bg-white z-1  sm:p-0">
        <div class="relative flex flex-col justify-center w-full h-screen  sm:p-0 lg:flex-row">
            <button x-data x-on:click="$dispatch('open-modal', 'example-modal')"
                class="px-4 py-2 bg-blue-600 text-white rounded">
                Buka Modal
            </button>

            <x-modal name="example-modal" :show="false" maxWidth="lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800">Judul Modal</h2>
                    <p>Ini adalah konten modal.</p>
                    <button class="mt-4 px-4 py-2 bg-gray-300 rounded"
                        x-on:click="$dispatch('close-modal', 'example-modal')">
                        Tutup
                    </button>
                </div>
            </x-modal>
            {{ $slot }}
        </div>
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script src="{{ asset('tailadmin/build/bundle.js') }}"></script>
    <script src="{{ asset('fontawesome/pro.min.js') }}"></script>
</body>

</html>
