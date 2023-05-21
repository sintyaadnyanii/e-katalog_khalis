@extends('layouts.main-layout')
@section('main-content')
    {{-- start header --}}
    <div class="w-full h-56 md:h-96 bg-cover bg-no-repeat relative"
        style="background-image: url('{{ asset('dist/images/product/bamboo-4.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="flex items-center justify-center h-full">
            <h2 class="text-white relative z-10 text-3xl font-bold">Product Details</h2>
        </div>
    </div>
    {{-- end header --}}

    {{-- start content --}}
    <div class="w-full m-0 py-5 px-4 flex flex-col md:flex-row gap-3 bg-gray-100">
        {{-- responsive filter and search --}}
        <div class="flex md:hidden w-full gap-1">
            <form action="{{ route('main.product') }}" method="GET"
                class="w-3/5 bg-white rounded-md shadow-md px-4 py-2 flex items-center justify-center">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input class="border-0 p-0 text-sm bg-transparent w-4/5 focus:ring-0" type="text" name="search"
                    id="search" placeholder="Search...">
                <button type="submit" class="text-right w-1/5 text-sm"><i class="fa-solid fa-search"></i></button>
            </form>
            <div class="w-2/5 relative bg-white rounded-md shadow-md px-4 py-2">
                <button type="button" class="text-right w-full text-sm flex items-center justify-between"
                    onclick="categoryDropdown()">
                    <span>Categories</span>
                    <i id="icon-dropdown" class="fa-solid fa-caret-down ml-1"></i>
                </button>
                {{-- category list dropdown --}}
                <div id="category-list"
                    class="hidden absolute bg-white shadow-md rounded-md top-full mt-1 left-0 w-full border p-2 z-50">
                    <ul class="mb-3 h-52 overflow-y-scroll">
                        <li>
                            <a href="{{ route('main.product') }}">All</a>
                        </li>
                        @foreach ($categories as $item)
                            <li class="{{ $product->category->slug == $item->slug ? 'text-[#B57E30]' : '' }}">
                                <a href="/products?category={{ $item->slug }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        {{-- end responsive filter and search --}}

        {{-- filter and search --}}
        <div class="hidden md:w-1/5 md:flex md:flex-col gap-2">
            <form action="{{ route('main.product') }}" method="GET"
                class="bg-white rounded-md shadow-md px-4 py-2 flex items-center justify-center">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input class="border-0 p-0 text-sm bg-transparent w-4/5 focus:ring-0" type="text" name="search"
                    id="search" placeholder="Search...">
                <button type="submit" class="text-right w-1/5 text-sm"><i class="fa-solid fa-search"></i></button>
            </form>
            <div class="bg-white rounded-md  shadow-md flex-col gap-1 py-4 px-5">
                <h2 class="text-lg font-semibold mb-3 uppercase">Categories</h2>
                <ul class="mb-3">
                    <li>
                        <a href="{{ route('main.product') }}">All</a>
                    </li>
                    @foreach ($categories as $item)
                        <li class="{{ $product->category->slug == $item->slug ? 'text-[#B57E30]' : '' }}">
                            <a href="/products?category={{ $item->slug }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- end filter & search --}}

        {{-- product detail --}}
        <div class="w-full md:w-4/5 bg-white rounded-md shadow border border-gray-200 p-5 flex flex-col">
            <div class="flex flex-col md:flex-row gap-3">
                <div class="md:basis-1/3 justify-center items-center px-3 py-2 md:p-0.5">
                    <div>
                        <img class="product-image"
                            src="{{ asset($product->images->count() ? 'storage/' . $product->images->first()->src : 'dist/images/post-1.jpg') }}"
                            alt="{{ asset($product->images->count() ? 'storage/' . $product->images->first()->alt : 'no-image') }}">
                    </div>
                    <div class="slider-wrapper mt-5 gap-2 mx-3 xl:mx-6">
                        <i id="arrow-left" class="fa-solid fa-chevron-left"></i>
                        <div id="thumbnail-slider" class="thumbnail-slider">
                            @foreach ($product->images as $index => $image)
                                <img class="product-thumbnail {{ $index == 0 ? 'active-thumbnail' : '' }}"
                                    src="{{ asset('storage/' . $image->src) }}"
                                    alt="product-image-{{ $loop->iteration }}">
                            @endforeach
                        </div>
                        <i id="arrow-right" class="fa-solid fa-chevron-right"></i>

                    </div>
                </div>
                <div class="md:basis-2/3">
                    <h3 class="font-bold text-xl">{{ $product->name }}</h3>
                    <div class="flex items-center gap-1">
                        {{-- <i class="fa-solid fa-heart text-[#D76A73]"></i> --}}
                        @auth
                            <button type="button"
                                onclick="addWishlist('{{ $product->product_code }}','{{ 0 }}')"><i
                                    class="{{ $product->wishlists->where('user_id', auth()->user()->id)->count() ? 'fa-solid fa-heart text-[#D76A73]' : 'fa-regular fa-heart' }}"
                                    id="like_icon_{{ 0 }}"></i></button>
                        @else
                            <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded" type="button"
                                onclick="showAlert()"><i class="fa-regular fa-heart"></i></button>
                        @endauth
                        <span>
                            <h4 class="font-medium text-sm">
                                <span>Liked by</span>
                                <span id="likes_{{ 0 }}"
                                    class="mx-0.5">{{ $product->wishlists->count() }}</span>
                                <span>{{ $product->wishlists->count() > 1 ? 'users' : 'user' }}</span>
                            </h4>
                        </span>
                    </div>
                    <h4 class="font-semibold text-primary text-lg text-[#B57E30]">
                        {{ pricing($product->price) }}</h4>
                    <div class="mt-2">{{ strip_tags($product->description) }}</div>
                    <hr class="mt-0.5">
                    <div class="w-full md:w-1/2 mt-3">
                        <div class="flex flex-row gap-1">
                            <div class="basis-1/3 md:basis-2/5">Category</div>
                            <div class="basis-2/3 md:basis-3/5">{{ ': ' . $product->category->name }}</div>
                        </div>
                        <div class="flex flex-row gap-1">
                            <div class="basis-1/3 md:basis-2/5">Dimensions</div>
                            <div class="basis-2/3 md:basis-3/5">{{ ': ' . $product->dimensions }}</div>
                        </div>
                        <div class="flex flex-row gap-1">
                            <div class="basis-1/3 md:basis-2/5">Materials</div>
                            <div class="basis-2/3 md:basis-3/5">{{ ': ' . $product->materials }}</div>
                        </div>
                        <div class="flex flex-row gap-1 mb-3">
                            <div class="basis-1/3 md:basis-2/5">Color</div>
                            <div class="basis-2/3 md:basis-3/5">{{ ': ' . $product->color }}</div>
                        </div>
                        @if (isset($product->link_shopee))
                            <a href="{{ $product->link_shopee }}" class="button-primary"><img class="w-5 mr-1"
                                    src="{{ asset('dist/images/icon-shopee.svg') }}" alt="icon"></i>Available
                                on Shopee</a>
                        @else
                            <button class="button-disabled" disabled>Not Available
                                on Shopee</button>
                        @endif
                        {{-- <a href="{{ $product->link_shopee ?? '#' }}"
                                    class="btn btn-primary text-light btn-sm mt-2"><i data-lucide="shopping-bag"
                                        class="w-5 mr-1"></i>{{ $product->link_shopee ? 'Available on Shopee' : 'Not Available on Shopee' }}</a> --}}
                    </div>

                </div>
            </div>
            <div class="flex item-center justify-end mt-8">
                <a href="{{ url()->previous() }}" class="text-[#455452] font-medium"><i
                        class="fa-solid fa-chevron-left text-sm mr-1"></i>Back</a>
            </div>
            {{-- product detail --}}

        </div>



    </div>
    {{-- start content --}}
@endsection
@section('main-script')
    <script>
        $(document).ready(function() {
            let thumbnails = document.getElementsByClassName('product-thumbnail');
            let activeImages = document.getElementsByClassName('active-thumbnail');
            for (let i = 0; i < thumbnails.length; i++) {
                thumbnails[i].addEventListener('mouseover', function() {
                    if (activeImages.length > 0) {
                        activeImages[0].classList.remove('active-thumbnail');
                    }
                    this.classList.add('active-thumbnail');
                    document.getElementsByClassName('product-image')[0].src = this.src;
                });
            }

            let btnLeft = document.getElementById('arrow-left');
            let btnRight = document.getElementById('arrow-right');

            btnLeft.addEventListener('click', function() {
                document.getElementById('thumbnail-slider').scrollLeft -= 180;
            });
            btnRight.addEventListener('click', function() {
                document.getElementById('thumbnail-slider').scrollLeft += 180;
            });
        });
    </script>
@endsection
