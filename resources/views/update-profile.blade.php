@extends('layouts.base-layout')
@section('base-head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- END: CSS Assets-->
@endsection
@section('base-body')
    @if (session()->has('warning'))
        @include('fragments.main-alert-warning')
    @endif
    @if (session()->has('error'))
        @include('fragments.main-alert-error')
    @endif
    @if (session()->has('success'))
        @include('fragments.main-alert-success')
    @endif
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
                        <img class="w-full" src="{{ asset('dist/images/icon/logo_khalis_white.png') }}" alt="logo">
                    </a>
                </div>
                <form action="{{ route('profile.patch', ['user' => $user]) }}" method="post" class="mt-4 w-full"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="deleted_image" id="deleted_image">
                    <h2 class="font-bold text-lg md:text-xl">
                        Edit Profile
                    </h2>
                    <div class="mt-3 flex flex-col md:flex-row gap-4">
                        <div class="md:w-1/4">
                            <div class="w-full">
                                {{-- <img id="image_preview" class="object-cover aspect-square w-full rounded"
                                        src="{{ asset('dist/images/placeholders/no-image.jpg') }}" alt="">
                                    @error('images.*')
                                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                    @enderror --}}
                                <div class="image-bg" id="image_preview"
                                    style="background-image: url({{ asset(isset($user->image->src) ? 'storage/' . $user->image->src : 'dist/images/placeholders/no-image.jpg') }})">
                                </div>
                                @error('image')
                                    <small
                                        class="text-xs text-red-500 mt-2 flex justify-center text-center">{{ '*' . $message }}</small>
                                @enderror
                                <div class="mt-3 flex items-center justify-center gap-1">
                                    <label class="btn-upload button button-sm button-secondary">
                                        <p id="btnLabel">Choose Image</p>
                                        <input type="file" name="image" id="image_profile" class="input-image"
                                            onchange="imageUpload()"
                                            data-id="{{ isset($user->image->id) ? $user->image->id : '' }}"
                                            data-file="{{ isset($user->image->id) ? 'storage/' . $user->image->src : '' }}">
                                    </label>
                                    <button type="button" class="button button-sm button-danger" onclick="deleteImage()"><i
                                            class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:w-3/4 gap-2">
                            <div>
                                <input type="email" id="email" name="email" class="new-form-control"
                                    value="{{ old('email') ?? $user->email }}" readonly>
                                @error('email')
                                    <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <input type="text" id="name" name="name" class="new-form-control"
                                    placeholder="Full Name *" value="{{ old('name') ?? $user->name }}">
                                @error('name')
                                    <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <input type="text" id="phone" name="phone" class="new-form-control"
                                    placeholder="Phone Number *" value="{{ old('phone') ?? $user->phone }}">
                                @error('phone')
                                    <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <input type="text" id="address" name="address" class="new-form-control"
                                    placeholder="Address" value="{{ old('address') ?? $user->address }}">
                                @error('address')
                                    <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>
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
@section('base-script')
    <script>
        let inputImg = document.getElementById("image_profile");
        let imgPreview = document.getElementById("image_preview");

        function imageUpload() {
            let imgReader = new FileReader();
            imgReader.readAsDataURL(inputImg.files[0]);
            imgReader.onload = function(e) {
                imgPreview.style.backgroundImage = "url(" + e.target.result + ")";
            }
        }

        function deleteImage() {
            var file = inputImg.getAttribute("data-file");
            let image_id = inputImg.getAttribute("data-id");
            if (file.includes("storage")) {
                document.getElementById("deleted_image").value = image_id;
            }
            inputImg.value = "";
            imgPreview.style.backgroundImage = "url('{{ asset('dist/images/placeholders/no-image.jpg') }}')";

        }

        const alertElement = document.getElementById('alert');
        const bodyElement = document.getElementsByTagName('body')[0];

        if (alertElement) {
            bodyElement.classList.add('overflow-hidden');
        } else {
            bodyElement.classList.remove('overflow-hidden');
        }

        function btnClose() {
            document.getElementById("alert").style.display = "none";
            document.getElementsByTagName('body')[0].classList.remove('overflow-hidden');
        }
    </script>
@endsection
