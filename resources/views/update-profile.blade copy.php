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
        <img alt="Khalis" class="w-14" src="{{ asset('dist/images/icon/logo_khalis_white.png') }}">
        <h2 class="font-bold text-lg mt-2 text-center text-white mb-5">Khalis Bali Bamboo</h2>
        <div class="bg-white shadow-md rounded-md py-5 px-10 md:w-2/5">
            <h2 class="font-bold text-base mt-2 mb-1">Edit Profile</h2>
            <hr>
            <form action="{{ route('profile.patch', ['user' => $user]) }}" method="POST" class="mt-5">
                @csrf
                @method('patch')
                <div>
                    <label for="name" class="form-label">Name</label>
                    @error('name')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="name" name="name" type="text"
                        class="new-form-control new-form-control-sm text-sm w-full" placeholder="Input your full name"
                        value="{{ old('name') ?? $user->name }}">
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="email" name="email" type="text"
                        class="new-form-control new-form-control-sm text-sm w-full" placeholder="Input your email address"
                        value="{{ old('email') ?? $user->email }}">
                </div>
                <div class="mt-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    @error('phone')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="phone" name="phone" type="text"
                        class="new-form-control new-form-control-sm text-sm w-full" placeholder="Input your phone number"
                        value="{{ old('phone') ?? $user->phone }}">
                </div>
                <div class="mt-3">
                    <label for="address" class="form-label">Address</label>
                    @error('address')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                    @enderror
                    <input id="address" name="address" type="text"
                        class="new-form-control new-form-control-sm text-sm w-full" placeholder="Input your address"
                        value="{{ old('address') ?? $user->address }}">
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
