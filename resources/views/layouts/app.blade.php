<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CCMS Ferwafa') }}</title>

   
    <!-- Optional: Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/dashlitee1e3.css">
    <link id="skin-default" rel="stylesheet" href="assets/css/themee1e3.css">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('layouts.sidebar')
            <div class="nk-wrap ">
                @include('layouts.navigation')
                <div class="nk-content ">
                    @yield('content')
                </div>
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2025 {{ config('app.name', 'CCMS Ferwafa') }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional: Your JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script src="assets/js/bundlee1e3.js"></script>
    <script src="assets/js/scriptse1e3.js"></script>
    <script src="assets/js/demo-settingse1e3.js"></script>
    <script src="assets/js/charts/gd-defaulte1e3.js"></script>
    <script src="../../assets/js/libs/datatable-btnse1e3.js"></script>
</body>

</html>