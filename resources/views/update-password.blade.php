@extends('layouts.base-layout')
@section('base-head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <!-- END: CSS Assets-->
@endsection
@section('base-body')
    @if (session()->has('warning'))
        @include('fragments.warning')
    @endif
    @if (session()->has('error'))
        @include('fragments.error')
    @endif
    @if (session()->has('success'))
        @include('fragments.success')
    @endif
    <div class="flex flex-col items-center justify-center h-screen">
        <img alt="Khalis" class="w-14" src="{{ asset('dist/images/logo_khalis_white.png') }}">
        <h2 class="font-bold text-lg mt-2 text-center text-white mb-5">Khalis Bali Bamboo</h2>
        <div class="bg-white shadow-md rounded-md py-5 px-10 md:w-2/5">
            <h2 class="font-bold text-base mt-2 mb-1">Change Password</h2>
            <hr>
            <form action="{{ route('password.patch') }}" method="POST" class="mt-5">
                @csrf
                @method('patch')
                <div>
                    <label for="old_password" class="form-label">Old Password</label>
                    @error('old_password')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="old_password" name="old_password" type="password"
                        class="form-control form-control-sm text-sm w-full" placeholder="Input Old Password"
                        value="{{ old('old_password') }}">
                </div>
                <div class="mt-3">
                    <label for="new_password" class="form-label">New Password</label>
                    @error('new_password')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="new_password" name="new_password" type="password"
                        class="form-control form-control-sm text-sm w-full" placeholder="Input New Password"
                        value="{{ old('new_password') }}">
                </div>
                <div class="mt-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    @error('confirm_password')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="confirm_password" name="confirm_password" type="password"
                        class="form-control form-control-sm text-sm w-full" placeholder="Confirm New Password"
                        value="{{ old('confirm_password') }}">
                </div>
                <div class="text-right mt-5">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    <button type="submit" class="btn btn-primary text-primary w-24 ">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('base-script')
    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- END: JS Assets-->
    <script>
        function btnClose() {
            document.getElementById("alert").style.display = "none";
        }
    </script>
@endsection
