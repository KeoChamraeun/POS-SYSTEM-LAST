<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/images/logo-sm.png') }}">
    <link rel="icon" type="image/jpg" href="{{ url('assets/images/logo-sm.png') }}">
    <title>{{ 'RAEUN POS' ?? env('APP_NAME') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/animate.css/animate.min.css') }}" rel="stylesheet" type="text/css"> 
    <link href="{{ asset('assets/libs/uppy/uppy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/vanillajs-datepicker/css/datepicker.min.css') }}" rel="stylesheet"
        type="text/css" /> 
    <link href="{{ asset('assets/libs/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="{{ asset('assets/js/jsscript.js') }}"></script>

    @livewireStyles
</head>

<body>
    @include('components.layouts.navbars.nav')
    @include('components.layouts.navbars.sidebar')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container-xxl">
                {{ $slot }}
            </div>
            @include('components.layouts.navbars.footer')
        </div>
    </div>
    @livewireScripts
    @stack('scripts')
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/data/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world.js') }}"></script>
    <script src="{{ asset('assets/js/pages/index.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/sweet-alert.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/file-upload.init.js') }}"></script>
    <script src="{{ asset('assets/libs/uppy/uppy.legacy.min.js') }}"></script>
    <script src="{{ asset('assets/libs/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/huebee/huebee.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms-advanced.js') }}"></script>
    <script src="{{ asset('assets/libs/mobius1-selectr/selectr.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/libs/imask/imask.min.js') }}"></script>

    <script>
        // Sweetalert
        document.addEventListener('livewire:init', () => { 
            Livewire.on('show-toast', (data) => {
                const {
                    type,
                    message
                } = data || {};
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2200,
                    timerProgressBar: true,
                    width: 'auto'
                });
                Toast.fire({
                    icon: type || 'info',
                    title: message || ''
                });
            });
        });

        // Switch theme mode (Dark and Light)
        document.addEventListener("DOMContentLoaded", function() { 
            const html = document.documentElement; 
            let savedTheme = localStorage.getItem("theme") || "light";
            html.setAttribute("data-bs-theme", savedTheme); 
            function toggleTheme() {
                let current = html.getAttribute("data-bs-theme");
                let next = current === "light" ? "dark" : "light"; 
                html.setAttribute("data-bs-theme", next);
                localStorage.setItem("theme", next);
            }
            document.addEventListener("toggle-theme", () => toggleTheme());
        });

        
    </script>
</body>

</html>