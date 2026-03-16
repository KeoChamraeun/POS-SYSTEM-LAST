<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <title>404 | Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="The page you are looking for could not be found.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/logo-sm.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-sm.png') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet"> 
    <style>
        :root {
            --bs-primary: #5AC559;
            --bs-primary-rgb: 90, 197, 89;
        }

        .btn-primary {
            background-color: #5AC559;
            border-color: #5AC559;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #4fb94f; /* slightly darker for hover */
            border-color: #4fb94f;
        }

        .text-primary {
            color: #5AC559 !important;
        }
    </style> 
</head>

<body class="bg-light" style="font-family: Kantumruy Pro, sans-serif">
    <div class="container-xxl">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden"> 
                    <div class="card-body bg-dark text-center py-4">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" height="50" alt="Logo">
                        </a>
                        <h4 class="mt-3 text-white fw-semibold">
                            {{__('Page Not Found')}}
                        </h4>
                        <p class="text-white-50 mb-0">
                            {{__('Sorry, the page you’re looking for doesn’t exist.')}}
                        </p>
                    </div> 
                    <div class="card-body text-center py-4">
                        <img src="{{ asset('assets/images/extra/error.svg') }}" height="160" alt="404 Error">

                        <h1 class="display-4 fw-bold text-primary my-2">404</h1>
                        <p class="text-muted mb-4">
                            {{__('It might have been removed, renamed, or temporarily unavailable.')}}
                        </p>

                        <a href="{{ route('dashboard') }}" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-home me-1"></i> {{__('Back to Dashboard')}}
                        </a>

                        <a href="javascript:history.back()" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-1"></i> {{__('Go Back')}}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
