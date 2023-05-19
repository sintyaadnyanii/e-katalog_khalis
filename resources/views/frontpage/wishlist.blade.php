@extends('layouts.main-layout')
@section('main-content')
    {{-- start header --}}
    <div class="w-full h-56 md:h-96 bg-cover bg-no-repeat relative"
        style="background-image: url('{{ asset('dist/images/product/bamboo-4.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="flex items-center justify-center h-full">
            <h2 class="text-white relative z-10 text-3xl font-bold">My Wishlist</h2>
        </div>
    </div>
    {{-- end header --}}

    {{-- start content --}}
    <div class="w-full m-0 py-5 px-4 flex flex-col md:flex-row gap-4 bg-gray-100">
        {{-- responsive filter and search --}}
        <div class="flex md:hidden w-full gap-1">
            <form action="{{ route('main.wishlist') }}" method="GET"
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
                            <a href="{{ route('main.wishlist') }}">All</a>
                        </li>
                        @foreach ($categories as $item)
                            <li class="{{ request('category') == $item->slug ? 'text-[#B57E30]' : '' }}">
                                <a href="/wishlist?category={{ $item->slug }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        {{-- end responsive filter and search --}}

        {{-- filter and search --}}
        <div class="hidden md:w-1/5 md:flex md:flex-col gap-2">
            <form action="{{ route('main.wishlist') }}" method="GET"
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
                        <a href="{{ route('main.wishlist') }}">All</a>
                    </li>
                    @foreach ($categories as $item)
                        <li class="{{ request('category') == $item->slug ? 'text-[#B57E30]' : '' }}">
                            <a href="/wishlist?category={{ $item->slug }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- end filter & search --}}
        <div class="w-full md:w-4/5 bg-white rounded-md shadow border border-gray-200 px-4 py-4 flex flex-col gap-3">
            {{-- wishlist table --}}
            <div class="overflow-x-auto rounded-md">
                <table class="w-full text-sm">
                    <thead class="text-sm md:text-base uppercase border-b-2 text-center">
                        <tr>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2">
                        @forelse ($wishlists as $item)
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="px-6 py-4 w-40">
                                    <img class="rounded w-full aspect-[4/3] object-cover"
                                        src="{{ asset($item->product->images->count() ? 'storage/' . $item->product->images->first()->thumb : 'dist/images/post-1.jpg') }}"
                                        alt="{{ $item->product->images->count() ? $item->product->images->first()->alt : 'product_image' }}">
                                </td>
                                <td class="px-6 py-4 text-center">{{ $item->product->name }} </td>
                                <td class="px-6 py-4 text-center">{{ $item->product->category->name }}</td>
                                <td class="px-6 py-4 text-right">{{ pricing($item->product->price) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-1 justify-center items-center">
                                        <a href="http://" class="button-primary flex items-center justify-center"><i
                                                class="fa-solid fa-info-circle mr-1"></i>Detail</a>
                                        <form action="{{ route('main.wishlist_delete', ['wishlist' => $item]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button-danger flex items-center justify-center"><i
                                                    class="fa-solid fa-trash mr-1"></i>Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted px-6 py-4" colspan="6">No Data</td>
                            </tr>
                            {{-- <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2 w-full">
                                No Data
                            </div> --}}
                        @endforelse

                    </tbody>
                </table>
            </div>


            {{-- <table class="w-full bg-white text-left">
                <thead class="text-center text-sm md:text-base uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-2">Image</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Price</th>
                        <th scope="col" class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b-2 whitespace-nowrap">
                        <td class="px-4">Image</td>
                        <td class="px-4">Product Name</td>
                        <td class="px-4">Product Price</td>
                        <td class="flex items-center justify-center gap-2 px-4">
                            <a href="http://" class="rounded py-1 px-2 bg-slate-500">Detail</a>
                            <a href="http://" class="rounded py-1 px-2 bg-slate-500">Remove</a>
                        </td>
                    </tr>
                </tbody>
            </table> --}}
            {{-- <div class="bg-red-300">Image
                </div>
                <div class="bg-blue-200">Name</div>
                <div class="bg-green-300">Price</div>
                <div class="bg-green-300">Action</div> --}}

            {{-- @forelse ($wishlists as $item)
                <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2 w-full">
                    No Data
                </div>
            @empty
                <div class="bg-white rounded-md shadow border border-gray-200 px-2 py-2 w-full">
                    No Data
                </div>
            @endforelse --}}
            {{-- end wishlist table --}}
            <div class="text-light flex justify-end">
                {{ $wishlists->links('fragments.pagination-frontpage') }}
            </div>

        </div>



    </div>
    {{-- start content --}}
@endsection
