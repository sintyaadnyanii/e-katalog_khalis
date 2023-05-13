@extends('layouts.main-layout')
@section('main-content')
    {{-- heading carousel --}}
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full bg-cover bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    style="background-image: url('{{ asset('dist/images/product/bamboo-2.jpg') }}')">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div
                        class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 text-left ml-10 md:ml-16">
                        <h2 class="text-base md:text-2xl font-bold text-white">Welcome to</h2>
                        <h1 class="text-xl md:text-4xl font-extrabold text-white">Khalis Bali Bamboo</h1>
                        <h2 class="text-base md:text-2xl font-bold text-white">Gallery {{ date('Y') }}</h2>
                        <p class="text-xs font-light md:text-base text-white mb-3 md:mb-5">We offer a various collection of
                            bamboo-based products such as furniture, cutleries, tumblers, lamps, and more.</p>
                        <a href="#"
                            class="text-xs md:text-base btn bg-[#566a68] text-white px-4 py-2 rounded-md">Explore Now</a>
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full bg-cover bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div
                        class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 text-left ml-10 md:ml-16">
                        <h2 class="text-base md:text-2xl font-bold text-white">Welcome to</h2>
                        <h1 class="text-xl md:text-4xl font-extrabold text-white">Khalis Bali Bamboo</h1>
                        <h2 class="text-base md:text-2xl font-bold text-white">Gallery {{ date('Y') }}</h2>
                        <p class="text-xs font-light md:text-base text-white mb-3 md:mb-5">We offer a various collection of
                            bamboo-based
                            products
                            such
                            as
                            furniture,
                            cutleries,
                            tumblers, lamps, and more.</p>
                        <a href="#"
                            class="text-xs md:text-base btn bg-[#566a68] text-white px-4 py-2 rounded-md">Explore Now</a>
                    </div>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full bg-cover bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    style="background-image: url('{{ asset('dist/images/product/bamboo-3.jpg') }}')">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div
                        class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 text-left ml-10 md:ml-16">
                        <h2 class="text-base md:text-2xl font-bold text-white">Welcome to</h2>
                        <h1 class="text-xl md:text-4xl font-extrabold text-white">Khalis Bali Bamboo</h1>
                        <h2 class="text-base md:text-2xl font-bold text-white">Gallery {{ date('Y') }}</h2>
                        <p class="text-xs font-light md:text-base text-white mb-3 md:mb-5">We offer a various collection of
                            bamboo-based
                            products
                            such
                            as
                            furniture,
                            cutleries,
                            tumblers, lamps, and more.</p>
                        <a href="#"
                            class="text-xs md:text-base btn bg-[#566a68] text-white px-4 py-2 rounded-md">Explore Now</a>
                    </div>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full bg-cover bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    style="background-image: url('{{ asset('dist/images/product/bamboo-4.jpg') }}')">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div
                        class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 text-left ml-10 md:ml-16">
                        <h2 class="text-base md:text-2xl font-bold text-white">Welcome to</h2>
                        <h1 class="text-xl md:text-4xl font-extrabold text-white">Khalis Bali Bamboo</h1>
                        <h2 class="text-base md:text-2xl font-bold text-white">Gallery {{ date('Y') }}</h2>
                        <p class="text-xs font-light md:text-base text-white mb-3 md:mb-5">We offer a various collection of
                            bamboo-based
                            products
                            such
                            as
                            furniture,
                            cutleries,
                            tumblers, lamps, and more.</p>
                        <a href="#"
                            class="text-xs md:text-base btn bg-[#566a68] text-white px-4 py-2 rounded-md">Explore Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-2 h-2 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-2 h-2 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-2 h-2 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-2 h-2 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="3"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-7 h-7 rounded-full sm:w-8 sm:h-8 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-2 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-7 h-7 rounded-full sm:w-8 sm:h-8 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-2 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    {{-- heading carousel --}}
@endsection
