@extends('layouts.base-layout')
@section('base-head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- END: CSS Assets-->
@endsection
@section('base-body')
    {{-- <div class="h-screen w-screen bg-cover bg-no-repeat relative"
        style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div> --}}
    <div class="flex items-center justify-center h-screen">
        <div class="relative">
            <div class="h-screen w-screen bg-cover bg-no-repeat relative"
                style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <div class="relative max-w-md bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#455452] w-20 h-20 flex items-center justify-center p-1">
                        <a class="text-3xl font-bold font-heading" href="{{ route('main') }}">
                            <img class="w-full" src="{{ asset('dist/images/logo_khalis_white.png') }}" alt="logo">
                        </a>
                    </div>
                    <form action="{{ route('attempt_login') }}" method="post" class="mt-5">
                        @csrf
                        <h2 class="font-bold text-xl md:text-2xl">
                            Login
                        </h2>
                        <div class="mt-6">
                            <div class="mt-4">
                                <input type="email" name="email" class="new-form-control py-3 px-4"
                                    placeholder="Email *" required>
                                @error('email')
                                    <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <input type="password" name="password" class="new-form-control py-3 px-4"
                                    placeholder="Password *" required>
                                @error('password')
                                    <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit" class="button button-lg button-primary w-full uppercase">Login</button>
                        </div>
                        <div class="mt-6 text-[#455452]  text-center text-sm">
                            Don't Have An Account?
                            <span><a class="underline underline-offset-1" href="{{ route('register') }}">Click
                                    Here</a></span>
                            <span>To Register Your Account!</span>
                        </div>
                    </form>
                </div>
                <div class="text-white text-center mt-8">Copyright<i class="mx-1 fa-regular fa-copyright"></i>2023 | All
                    right
                    reserved
                    by
                    Khalis Bali
                    Bamboo, Ltd.</div>
            </div>
        </div>
    </div>
@endsection
