@extends('layouts.main-layout')
@section('main-content')
    {{-- start header --}}
    <div class="w-full h-56 md:h-96 bg-cover bg-no-repeat relative"
        style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="flex items-center justify-center h-full">
            <h1 class="text-white relative z-10 text-4xl font-bold">About Us</h1>
        </div>
    </div>
    {{-- end header --}}
    <div class="w-full m-0 p-5 lg:p-10 flex flex-col gap-3 bg-gray-100 items-center justify-center">
        <div class="flex flex-col lg:flex-row gap-5 bg-white w-full shadow p-8 rounded-md">
            <div class="w-full md:w-1/2 flex flex-col gap-5">
                <div class="w-full flex flex-col gap-3">
                    <h2 class="font-semibold text-xl md:text-2xl mb-3">Contact Detail</h2>
                    <div class="flex flex-row gap-2">
                        <div class="w-8 h-8 flex items-center justify-center bg-[#455452]">
                            <i class="text-white fa-solid fa-shop"></i>
                        </div>
                        <div class="text-sm flex flex-col h-8 justify-center">
                            <a href="https://goo.gl/maps/DcKMbkzUR31ixBV97">Jl. Kebo Iwa No.46, Belega, Kec. Blahbatuh,
                                Kabupaten Gianyar, Bali 80581</a>
                        </div>
                    </div>
                    <div class="flex flex-row gap-2">
                        <div class="w-8 h-8 flex items-center justify-center bg-[#455452]">
                            <i class="text-white fa-solid fa-warehouse"></i>
                        </div>
                        <div class="text-sm flex flex-col h-8 justify-center">
                            <a href="https://goo.gl/maps/pcXqU5Xg5pohguEQA">Jl. Padat Karya, Belega, Kec. Blahbatuh,
                                Kabupaten Gianyar, Bali 80581</a>
                        </div>
                    </div>
                    <div class="flex flex-row gap-2">
                        <div class="w-8 h-8 flex items-center justify-center bg-[#455452]">
                            <i class="text-white fa-brands fa-whatsapp text-xl"></i>
                        </div>
                        <div class="text-sm flex flex-col h-8 justify-center">
                            <a href="https://wa.me/6281231065880/?text=Hello%20Khalis%20Bali%20Bamboo,">+62
                                812-3106-5880</a>
                        </div>
                    </div>
                    <div class="flex flex-row gap-2">
                        <div class="w-8 h-8 flex items-center justify-center bg-[#455452]">
                            <i class="text-white fa-solid fa-envelope"></i>
                        </div>
                        <div class="text-sm flex flex-col h-8 justify-center">
                            <a href="mailto:anjasmarayogi64@gmail.com">anjasmarayogi64@gmail.com</a>
                        </div>
                    </div>
                    {{-- <ul>
                        <li>Whatsapp</li>
                        <li>Email</li>
                        <li>Instagram</li>
                        <li>Facebook</li>
                    </ul> --}}
                </div>
                <div class="w-full">
                    <h2 class="font-semibold text-xl md:text-2xl mb-3">Follow Us</h2>
                    <div class="flex flex-row gap-2">
                        <div class="w-8 h-8 p-1 flex items-center justify-center rounded-full border-2 border-[#455452]">
                            <a class="flex items-center justify-center"
                                href="https://www.instagram.com/khalis_bali_bamboo/"><i
                                    class="text-[#455452] fa-brands fa-instagram text-xl text-center"></i></a>
                        </div>
                        <div class="w-8 h-8 p-1 flex items-center justify-center rounded-full border-2 border-[#455452]">
                            <a class="flex items-center justify-center" href="https://www.facebook.com/khalisbali/"><i
                                    class="text-[#455452] fa-brands fa-facebook text-xl text-center"></i></a>
                        </div>
                        <div class="w-8 h-8 p-1 flex items-center justify-center rounded-full border-2 border-[#455452]">
                            <a class="flex items-center justify-center" href="https://shopee.co.id/khalisbalibamboo"><img
                                    class="w-5" src="{{ asset('dist/images/icon/shopee_logo_primary.png') }}"
                                    alt="icon"></a>
                        </div>
                    </div>
                </div>
                {{-- Feedback Form --}}
                <div class="w-full">
                    <h2 class="font-semibold text-xl md:text-2xl mb-3">Send Us Your Feedback</h2>
                    <form action="{{ route('main.feedback_store') }}" method="post">
                        @csrf
                        <div>
                            <label for="rating" class="form-label text-sm">How Was Your Experience?</label>
                            @error('rating')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <div class="flex gap-1 mt-2 mb=3">
                                <i class="star fa-solid fa-star text-lg"></i>
                                <i class="star fa-solid fa-star text-lg"></i>
                                <i class="star fa-solid fa-star text-lg"></i>
                                <i class="star fa-solid fa-star text-lg"></i>
                                <i class="star fa-solid fa-star text-lg"></i>
                            </div>
                            <input id="rating" name="rating" type="text" class="hidden" value="{{ old('rating') }}"
                                placeholder="0/5" required>
                        </div>

                        <div class="mt-2">
                            <label for="message" class="form-label text-sm">
                                Is there Anything Else You'd Like to Share?</label>
                            @error('message')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <textarea id="message" name="message" type="text" class="new-form-control mt-2 mb-3"
                                placeholder="Type Your Message">{!! old('message') !!}</textarea>
                        </div>
                        <div class="mt-3">
                            @auth
                                <button type="submit" class="button button-lg button-primary w-32">Submit</button>
                            @else
                                <button class="button button-lg button-primary w-32" type="button"
                                    onclick="showAlert()">Submit</button>
                            @endauth
                        </div>
                    </form>
                </div>
                {{-- Feedback Form --}}

            </div>
            <div class="order-first md:order-none w-full h-60 md:h-auto md:w-1/2">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.3107009353753!2d115.3044341748657!3d-8.56609339147791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd215e09dab354d%3A0xe70becb2da2bd0a0!2sKhalis%20Bali%20Bamboo!5e0!3m2!1sid!2sid!4v1687142803084!5m2!1sid!2sid&amp;cookielaw=0"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
@endsection
@section('main-script')
    <script src="{{ asset('dist/js/view/dashboard/manage-feedback.js') }}"></script>
@endsection
