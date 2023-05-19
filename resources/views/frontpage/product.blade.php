@extends('layouts.main-layout')
@section('main-content')
    {{-- start header --}}
    <div class="w-full h-56 md:h-96 bg-cover bg-no-repeat relative"
        style="background-image: url('{{ asset('dist/images/product/bamboo-4.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="flex items-center justify-center h-full">
            <h2 class="text-white relative z-10 text-3xl font-bold">Our Products</h2>
        </div>
    </div>
    {{-- end header --}}

    {{-- start content --}}
    <div class="w-full m-0 py-5 px-4 flex flex-col md:flex-row gap-4 bg-gray-100">
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
                        <li class="{{ request()->has('category') ? '' : 'text-[#B57E30]' }}">
                            <a href="{{ route('main.product') }}">All</a>
                        </li>
                        @foreach ($categories as $item)
                            <li class="{{ request('category') == $item->slug ? 'text-[#B57E30]' : '' }}">
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
                    <li class="{{ request()->has('category') ? '' : 'text-[#B57E30]' }}">
                        <a href="{{ route('main.product') }}">All</a>
                    </li>
                    @foreach ($categories as $item)
                        <li class="{{ request('category') == $item->slug ? 'text-[#B57E30]' : '' }}">
                            <a href="/products?category={{ $item->slug }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- end filter & search --}}
        <div class="w-full md:w-4/5 flex flex-col gap-5">
            {{-- product list --}}
            <div class="flex flex-col gap-2 md:grid md:grid-cols-3 lg:grid-cols-4 md:gap-3">
                {{-- product card --}}
                @forelse ($products as $index=>$item)
                    <div class="bg-white rounded-md shadow border border-gray-200 px-4 py-4">
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
                            <h2 class="font-semibold text-lg text-[#B57E30]">
                                {{ pricing($item->price) }}</h2>
                            <div class="flex items-center gap-1 mt-2">
                                @auth
                                    <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded" type="button"
                                        onclick="addWishlist('{{ $item->product_code }}','{{ $index }}')"><i
                                            class="{{ $item->wishlist->where('user_id', auth()->user()->id)->count() ? 'fa-solid fa-heart text-[#D76A73]' : 'fa-regular fa-heart' }}"
                                            id="like_icon_{{ $index }}"></i></button>
                                @else
                                    <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded" type="button"
                                        onclick="showAlert()"><i class="fa-regular fa-heart"></i></button>
                                @endauth
                                <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded"><i
                                        class="fa-solid fa-circle-info"></i></button>
                            </div>
                            <h5 class="text-xs mt-1">
                                <span>Liked by</span>
                                <span id="likes_{{ $index }}" class="mx-0.5">{{ $item->wishlist->count() }}</span>
                                <span>{{ $item->wishlist->count() > 1 ? 'users' : 'user' }}</span>
                            </h5>
                        </div>
                        {{-- <div id="wishlist_notif"
                            class="relative bottom-0 left-0 rounded w-full z-10 shadow-sm py-1 px-2 text-white bg-slate-400">
                            <h2>
                                <span class="text-sm" id="notif_msg">Messages</span>
                                <span><a id="wishlist_link" href="http://" class="text-sm underline">Check here</a></span>
                            </h2>
                        </div> --}}
                    </div>
                @empty
                    <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2 md:col-span-full self-start">
                        No Data
                    </div>
                @endforelse

            </div>
            {{-- end product list --}}
            <div class="text-light flex justify-end">
                {{ $products->links('fragments.pagination-frontpage') }}
            </div>
        </div>



    </div>
    {{-- start content --}}
@endsection
