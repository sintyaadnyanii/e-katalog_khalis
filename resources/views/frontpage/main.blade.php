@extends('layouts.main-layout')
@section('main-content')
    {{-- heading carousel --}}
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                <div class="absolute w-full h-full bg-cover bg-center bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
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
                <div class="absolute w-full h-full bg-cover bg-center bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
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
                <div class="absolute w-full h-full bg-cover bg-center bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
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
                <div class="absolute w-full h-full bg-cover bg-center bg-no-repeat -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
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
    {{-- begin: top liked product --}}
    <div class="w-full bg-gray-100 px-8 py-10 flex flex-col items-center justify-center">
        <div class="mb-6">
            <strong class="text-center text-2xl md:text-3xl">Top Liked Products</strong>
        </div>
        {{-- product list --}}
        <div class="flex flex-col gap-4 md:gap-6 md:flex-row items-center justify-center">
            {{-- product card --}}
            @forelse ($top_products->take(3) as $index=>$item)
                <div
                    class="bg-white rounded-md shadow border border-gray-200 px-4 py-4 md:w-64 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative mb-2">
                        <img class="object-cover w-full aspect-square rounded"
                            src="{{ asset($item->images->count() ? 'storage/' . $item->images->first()->src : 'dist/images/post-1.jpg') }}"
                            alt="{{ $item->images->count() ? $item->images->first()->alt : 'product_image' }}">
                        {{-- banner --}}
                        {{-- <div class="absolute top-2 left-0 bg-[#CD9347] text-white px-2 py-1 rounded-e-md">
                                $99.99
                            </div> --}}
                    </div>
                    <div class="mb-3">
                        <h2 class="font-semibold text-lg uppercase">{{ $item->name }}</h2>
                        <h3 class="text-sm font-medium text-[#B0B0B0] -mt-1">{{ $item->category->name }}</h3>
                        <h2 class="font-bold text-lg text-[#B57E30]">
                            {{ pricing($item->price) }}</h2>
                        <div class="flex items-center gap-1 mt-2">
                            @auth
                                <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded" type="button"
                                    onclick="addWishlist('{{ $item->product_code }}','{{ $index }}')"><i
                                        class="{{ $item->wishlists->where('user_id', auth()->user()->id)->count() ? 'fa-solid fa-heart text-[#D76A73]' : 'fa-regular fa-heart' }}"
                                        id="like_icon_{{ $index }}"></i></button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-8 aspect-square text-black border-2 border-gray-600 rounded flex justify-center items-center"><i
                                        class="fa-regular fa-heart"></i></a>
                            @endauth
                            <a href="{{ route('main.product_detail', ['product' => $item]) }}"
                                class="w-8 aspect-square text-black border-2 border-gray-600 rounded flex items-center justify-center"><i
                                    class="fa-solid fa-circle-info"></i></a>
                        </div>
                        <h5 class="text-xs mt-1">
                            <span>Liked by</span>
                            <span id="likes_{{ $index }}" class="mx-0.5">{{ $item->wishlists->count() }}</span>
                            <span>{{ $item->wishlists->count() > 1 ? 'users' : 'user' }}</span>
                        </h5>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2 md:col-span-full self-start">
                    No Data
                </div>
            @endforelse

        </div>
        {{-- end product list --}}
    </div>
    {{-- end: top liked product --}}
    {{-- begin: latest product --}}
    <div class="w-full bg-gray-100 px-8 py-10 flex flex-col items-center justify-center">
        <div class="mb-6">
            <strong class="text-center text-2xl md:text-3xl">Latest Products</strong>
        </div>
        {{-- product list --}}
        <div class="flex flex-col gap-4 md:gap-6 md:flex-row items-center justify-center">
            {{-- product card --}}
            @forelse ($latest_products->take(3) as $index=>$item)
                <div
                    class="bg-white rounded-md shadow border border-gray-200 px-4 py-4 md:w-64 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative mb-2">
                        <img class="object-cover w-full aspect-square rounded"
                            src="{{ asset($item->images->count() ? 'storage/' . $item->images->first()->src : 'dist/images/post-1.jpg') }}"
                            alt="{{ $item->images->count() ? $item->images->first()->alt : 'product_image' }}">
                        {{-- banner --}}
                        {{-- <div class="absolute top-2 left-0 bg-[#CD9347] text-white px-2 py-1 rounded-e-md">
                                $99.99
                            </div> --}}
                    </div>
                    <div class="mb-3">
                        <h2 class="font-semibold text-lg uppercase">{{ $item->name }}</h2>
                        <h3 class="text-sm font-medium text-[#B0B0B0] -mt-1">{{ $item->category->name }}</h3>
                        <h2 class="font-bold text-lg text-[#B57E30]">
                            {{ pricing($item->price) }}</h2>
                        <div class="flex items-center gap-1 mt-2">
                            @auth
                                <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded" type="button"
                                    onclick="addWishlist('{{ $item->product_code }}','{{ $index }}')"><i
                                        class="{{ $item->wishlists->where('user_id', auth()->user()->id)->count() ? 'fa-solid fa-heart text-[#D76A73]' : 'fa-regular fa-heart' }}"
                                        id="like_icon_{{ $index }}"></i></button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-8 aspect-square text-black border-2 border-gray-600 rounded flex justify-center items-center"><i
                                        class="fa-regular fa-heart"></i></a>
                            @endauth
                            <a href="{{ route('main.product_detail', ['product' => $item]) }}"
                                class="w-8 aspect-square text-black border-2 border-gray-600 rounded flex items-center justify-center"><i
                                    class="fa-solid fa-circle-info"></i></a>
                        </div>
                        <h5 class="text-xs mt-1">
                            <span>Liked by</span>
                            <span id="likes_{{ $index }}" class="mx-0.5">{{ $item->wishlists->count() }}</span>
                            <span>{{ $item->wishlists->count() > 1 ? 'users' : 'user' }}</span>
                        </h5>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2 md:col-span-full self-start">
                    No Data
                </div>
            @endforelse

        </div>
        {{-- end product list --}}
    </div>
    {{-- end: latest product --}}
@endsection
