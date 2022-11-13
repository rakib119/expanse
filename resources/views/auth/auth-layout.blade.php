<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <title> @yield('page-title')</title>

</head>

<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center">
        <div class="splash-container">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <a href="/"><img class="logo-img" src="{{ asset('assets/images/logo.png') }}"
                            alt="logo"></a><span class="splash-description">@yield('form-title')</span>
                </div>
                @yield('auth-content')
            </div>
        </div>
    </div>
      <!-- Theme JS -->
  <script src=" {{asset('assets/js/theme.min.js')}}"></script>
</body>

</html>
