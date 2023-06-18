<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'E-Katalog' }}</title>
    <link rel="shortcut icon" href="{{ asset('dist/images/logo_khalis.png') }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V3FRTX74XY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-V3FRTX74XY');
    </script>
    @yield('base-head')
</head>

<body class="p-0">
    @yield('base-body')

    @yield('base-script')

</body>

</html>
