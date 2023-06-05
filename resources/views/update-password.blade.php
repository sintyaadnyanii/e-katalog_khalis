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
        <div class="absolute inset-0 flex flex-col items-center justify-center gap-5">
            <div
                class="relative w-[80%] md:w-[40%] bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center">
                <div
                    class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#455452] w-16 h-16 md:w-20 md:h-20 flex items-center justify-center p-1">
                    <a class="text-3xl font-bold font-heading" href="{{ route('main') }}">
                        <img class="w-full" src="{{ asset('dist/images/logo_khalis_white.png') }}" alt="logo">
                    </a>
                </div>
                <form action="{{ route('password.patch') }}" method="post" class="mt-5 w-full">
                    @csrf
                    @method('patch')
                    <h2 class="font-bold text-lg md:text-xl">
                        Change Password
                    </h2>
                    <div class="mt-6">
                        <div class="mt-4">
                            <input id="old_password" name="old_password" type="password"
                                class="new-form-control py-2 px-3 md:py-3 md:px-4" placeholder="Old Password *" required>
                            @error('old_password')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input id="new_password" name="new_password" type="password"
                                class="new-form-control py-2 px-3 md:py-3 md:px-4" placeholder="New Password *" required>
                            @error('new_password')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input id="confirm_password" name="confirm_password" type="password"
                                class="new-form-control py-2 px-3 md:py-3 md:px-4" placeholder="Confirm New Password *"
                                required>
                            @error('confirm_password')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 md:mt-8 text-center flex items-center justify-center gap-2">
                        <button type="submit" class="button button-lg button-primary w-full uppercase">Save</button>
                        <a href="{{ url()->previous() }}"
                            class="button button-lg button-outline-primary w-full uppercase">Cancel</a>
                    </div>
                </form>
            </div>
            <div class="text-white text-sm md:text-base text-center px-8">Copyright<i
                    class="mx-1 fa-regular fa-copyright"></i>2023 | All
                right
                reserved
                by
                Khalis Bali
                Bamboo, Ltd.</div>
        </div>
    </div>
@endsection
