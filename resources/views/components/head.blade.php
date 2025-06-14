<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        PillPay
    </title>
    <link rel="icon" href="{{ asset('tailadmin/build/favicon.ico') }}">
    <link href="{{ asset('tailadmin/build/style1.css') }}" rel="stylesheet">
    @vite(['resources/js/notyf-admin.js'])
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
