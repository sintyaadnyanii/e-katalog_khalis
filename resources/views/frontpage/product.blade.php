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
            <form class="w-3/5 bg-white rounded-md shadow-md px-4 py-2 flex items-center justify-center">
                <input class="border-0 p-0 text-sm bg-transparent w-4/5" type="text" name="search" id="search"
                    placeholder="Search...">
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
                        @foreach ($categories as $item)
                            <li><a href="http://">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        {{-- end responsive filter and search --}}

        {{-- filter and search --}}
        <div class="hidden md:w-1/5 md:flex md:flex-col gap-2">
            <form class="bg-white rounded-md shadow-md px-4 py-2 flex items-center justify-center">
                <input class="border-0 p-0 text-sm bg-transparent w-4/5" type="text" name="search" id="search"
                    placeholder="Search...">
                <button type="submit" class="text-right w-1/5 text-sm"><i class="fa-solid fa-search"></i></button>
            </form>
            <div class="bg-white rounded-md  shadow-md flex-col gap-1 py-4 px-5">
                <h2 class="text-lg font-semibold mb-3 uppercase">Categories</h2>
                <ul class="mb-3">
                    @foreach ($categories as $item)
                        <li><a href="http://">{{ $item->name }}</a></li>
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
                    <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2">
                        <div class="relative mb-2">
                            <img class="object-cover w-full aspect-square rounded-md"
                                src="{{ asset($item->images->count() ? 'storage/' . $item->images->first()->src : 'dist/images/post-1.jpg') }}"
                                alt="{{ $item->images->count() ? $item->images->first()->alt : 'product_image' }}">
                            {{-- banner --}}
                            <div class="absolute top-2 left-0 bg-[#CD9347] text-white px-2 py-1 rounded-e-md">
                                $99.99
                            </div>
                        </div>
                        <div class="mb-3">
                            <h2 class="font-semibold text-lg uppercase">{{ $item->name }}</h2>
                            <h3 class="text-sm font-medium text-[#B0B0B0] -mt-1">{{ $item->category->name }}</h3>
                            <h2 class="font-semibold text-lg text-[#D76A73]">
                                {{ pricing($item->price) }}</h2>
                            <div class="flex items-center gap-1 mt-2">
                                <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded"><i
                                        class="fa-regular fa-heart"></i></button>
                                <button class="w-8 aspect-square text-black border-2 border-gray-600 rounded"><i
                                        class="fa-solid fa-circle-info"></i></button>
                            </div>
                            <h5 class="text-xs mt-1">Liked by 1000 users</h5>
                        </div>
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
