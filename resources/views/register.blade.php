@extends('layouts.base-layout')
@section('base-head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- END: CSS Assets-->
@endsection
@section('base-body')
    <div class="h-screen w-screen relative">
        <div class="absolute inset-0 bg-cover bg-no-repeat"
            style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
        </div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center overflow-y-scroll gap-5">
            <div
                class="relative w-[80%] md:w-[60%] bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center">
                <div
                    class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#455452] w-16 h-16 md:w-20 md:h-20 flex items-center justify-center p-1">
                    <a class="text-3xl font-bold font-heading" href="{{ route('main') }}">
                        <img class="w-full" src="{{ asset('dist/images/logo_khalis_white.png') }}" alt="logo">
                    </a>
                </div>
                <form action="{{ route('attempt_register') }}" method="post" class="mt-5 w-full">
                    @csrf
                    <h2 class="font-bold text-lg md:text-xl">
                        Register
                    </h2>
                    <div class="mt-3 flex flex-col md:grid md:grid-cols-2 gap-2 md:gap-4">
                        <div>
                            <input type="text" name="name" class="new-form-control py-2 px-3 md:py-3 md:px-4"
                                placeholder="Full Name *" value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="email" name="email" class="new-form-control py-2 px-3 md:py-3 md:px-4"
                                placeholder="Email *" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="phone" class="new-form-control py-2 px-3 md:py-3 md:px-4"
                                placeholder="Phone Number *" value="{{ old('phone') }}" required>
                            @error('phone')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="address" class="new-form-control py-2 px-3 md:py-3 md:px-4"
                                placeholder="Address" value="{{ old('address') }}">
                            @error('address')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="password" name="password" class="new-form-control py-2 px-3 md:py-3 md:px-4"
                                placeholder="Password *" required>
                            @error('password')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="password" name="password_confirm"
                                class="new-form-control py-2 px-3 md:py-3 md:px-4" placeholder="Password Confirmation *"
                                required>
                            @error('password_confirm')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="flex text-slate-600 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="redirect_login" name="redirect_login" type="checkbox"
                                class="checkbox-input border mr-2">
                            <label class="cursor-pointer select-none" for="redirect_login">Login Dirrectly</label>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button type="submit" class="button button-lg button-primary w-full uppercase">Register</button>
                    </div>
                    <div class="mt-6 text-[#455452]  text-center text-sm">
                        Already Have An Account?
                        <span><a class="underline underline-offset-1" href="{{ route('login') }}">Click
                                Here</a></span>
                        <span>To Sign-In!</span>
                    </div>
                </form>
            </div>
            <div class="text-white text-sm md:text-base text-center px-8">Copyright<i
                    class="mx-1 fa-regular fa-copyright"></i>2023 |
                All
                right
                reserved
                by
                Khalis Bali
                Bamboo, Ltd.</div>
        </div>
    </div>
@endsection
