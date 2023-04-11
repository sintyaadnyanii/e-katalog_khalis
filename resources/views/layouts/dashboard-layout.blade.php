@extends('layouts.base-layout')
@section('base-head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <!-- END: CSS Assets-->
@endsection
@section('base-body')
    <div class="py-5 px-5 bg-primary">
        <!-- BEGIN: Mobile Menu -->
        @include('fragments.dashboard-mobile-menu')
        <!-- END: Mobile Menu -->
        <div class="flex mt-[4.7rem] md:mt-0">
            <!-- BEGIN: Side Menu -->
            @include('fragments.dashboard-sidemenu')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('fragments.dashboard-topbar')
                <!-- END: Top Bar -->
                @include('fragments.dashboard-content')
            </div>
            <!-- END: Content -->
        </div>


    </div>
@endsection
@section('base-script')
    <!-- BEGIN: JS Assets-->
    {{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script> --}}
    <script src="{{ asset('dist/js/app.js') }}"></script>

    <!-- BEGIN: Tinymce -->
    <script src="https://cdn.tiny.cloud/1/za5uofdzyu47c9jrtt2g8dkm5h583ou8yqetl3p4f7s8bqjh/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'autoresize link lists searchreplace wordcount',
            toolbar: 'undo redo | blocks | bold italic | indent outdent | bullist numlist'
        });
    </script>
    <!-- END: Tinymce-->
    @yield('script')


    <!-- END: JS Assets-->
@endsection
