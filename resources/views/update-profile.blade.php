@extends('layouts.base-layout')
@section('base-head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- END: CSS Assets-->
@endsection
@section('base-body')
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative">
            <div class="h-screen w-screen bg-cover bg-no-repeat relative"
                style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            <div class="absolute inset-0 flex flex-col items-center justify-center overflow-y-auto">
                <div
                    class="relative w-[80%] md:w-[60%] bg-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#455452] w-20 h-20 flex items-center justify-center p-1">
                        <a class="text-3xl font-bold font-heading" href="{{ route('main') }}">
                            <img class="w-full" src="{{ asset('dist/images/logo_khalis_white.png') }}" alt="logo">
                        </a>
                    </div>
                    <form action="{{ route('profile.patch', ['user' => $user]) }}" method="post" class="mt-4 w-full">
                        @csrf
                        @method('PATCH')
                        <h2 class="font-bold text-xl md:text-2xl">
                            Edit Profile
                        </h2>
                        <div class="mt-3 flex flex-col md:flex-row gap-4">
                            <div class="md:w-1/4">
                                <div class="w-full">
                                    <img id="image-preview" class="object-cover w-full rounded"
                                        src="{{ asset('dist/images/profile-14.jpg') }}" alt="">
                                    @error('images.*')
                                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                    @enderror
                                    <div class="mt-3 text-center">
                                        <label class="btn-upload button button-sm button-secondary">
                                            <p id="btnLabel">Choose Image</p>
                                            {{-- <input type="file" name="image" id="image_profile" class="input-image"
                                                onchange="imageUpload()"> --}}
                                        </label>
                                        <button class="button button-sm button-danger"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:w-3/4 gap-2">
                                <div>
                                    <input type="text" name="name" class="new-form-control py-3 px-4"
                                        placeholder="Full Name *" value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <input type="email" name="email" class="new-form-control py-3 px-4"
                                        placeholder="Email *" value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <input type="text" name="phone" class="new-form-control py-3 px-4"
                                        placeholder="Phone Number *" value="{{ old('phone') ?? $user->phone }}">
                                    @error('phone')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <input type="text" name="address" class="new-form-control py-3 px-4"
                                        placeholder="Address" value="{{ old('address') ?? $user->address }}">
                                    @error('address')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 text-center flex items-center justify-center gap-2">
                            <button type="submit" class="button button-lg button-primary w-full uppercase">Save</button>
                            <a href="{{ url()->previous() }}"
                                class="button button-lg button-outline-primary w-full uppercase">Cancel</a>
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
@section('base-script')
    <script>
        function imageUpload() {
            let inputImg = document.getElementById("img_upload");
            let imgPreview = document.getElementById("img_preview");

            let imgReader = new FileReader();
            imgReader.readAsDataURL(inputImg.files[0]);
            console.log(inputImg.files[0]);
            imgReader.onload = function(e) {
                imgPreview.setAttribute("src", e.target.result);
            }
        }
    </script>
@endsection
