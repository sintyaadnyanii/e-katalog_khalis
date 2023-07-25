@extends('layouts.base-layout')
@section('base-head')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6SR51K7EDB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-6SR51K7EDB');
    </script>
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('base-body')
    @include('fragments.main-navbar')
    {{-- alert --}}
    @if (session()->has('warning'))
        @include('fragments.main-alert-warning')
    @endif
    @if (session()->has('error'))
        @include('fragments.main-alert-error')
    @endif
    @if (session()->has('success'))
        @include('fragments.main-alert-success')
    @endif
    {{-- alert --}}
    @yield('main-content')
    @include('fragments.main-footer')
@endsection
@section('base-script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="{{ asset('dist/js/view/frontpage/main.js') }}"></script>
    @yield('main-script')
    <!-- BEGIN: Alert Popup -->
    <script>
        const alertElement = document.getElementById('alert');
        const defaultCarousel = document.getElementById('default-carousel');
        const bodyElement = document.getElementsByTagName('body')[0];

        if (alertElement) {
            bodyElement.classList.add('overflow-hidden');
        } else {
            bodyElement.classList.remove('overflow-hidden');
        }

        function btnClose() {
            document.getElementById("alert").style.display = "none";
            bodyElement.classList.remove('overflow-hidden');
        }
    </script>
    <!-- END Alert Popup -->
@endsection
