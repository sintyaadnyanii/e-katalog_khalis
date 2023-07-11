@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="p-5">
        <div class="intro-y flex items-center mt-3">
            <h2 class="text-lg font-medium mr-auto">
                Customer Detail
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Profile Info -->
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="User Profile Image" class="rounded-md"
                                    src="{{ asset(isset($user->image->src) ? 'storage/' . $user->image->src : 'dist/images/placeholders/no-image.jpg') }}">
                            </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                                    {{ $user->name }}</div>
                                <div class="text-slate-500">{{ $user->level }}</div>
                            </div>
                        </div>
                        <div
                            class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="font-medium text-left lg:mt-3">Contact Details</div>
                            <div class="flex flex-col justify-center items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail"
                                        class="w-4 h-4 mr-2"></i> {{ $user->email }} </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone"
                                        class="w-4 h-4 mr-2"></i> {{ $user->phone }} </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="map-pin"
                                        class="w-4 h-4 mr-2"></i> {{ $user->address ? $user->address : 'Unknown' }} </div>
                            </div>
                        </div>
                        <div
                            class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 pt-5 lg:pt-0">
                            <div class="text-center rounded-md w-20 py-3">
                                <div class="font-medium text-primary text-xl">{{ $user->wishlists->count() }}</div>
                                <div class="text-slate-500">Wishlist</div>
                            </div>
                            <div class="text-center rounded-md w-20 py-3">
                                <div class="font-medium text-primary text-xl">{{ $user->feedbacks->count() }}</div>
                                <div class="text-slate-500">Feedback</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Profile Info -->

                <!-- BEGIN: Customer's Wishlist -->
                <div class="intro-y box px-5 py-5 mt-5">
                    <div class="flex items-center px-5 py-5 sm:py-3">
                        <h2 class="font-medium text-base mr-auto">
                            Customer's Wishlist
                        </h2>
                    </div>
                    <div class="mt-8 intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-hover -mt-2">
                            <thead>
                                <tr>
                                    <th class="text-center whitespace-nowrap">NO</th>
                                    <th class="text-center whitespace-nowrap">PRODUCT CODE</th>
                                    <th class="text-center whitespace-nowrap">IMAGE</th>
                                    <th class="text-center whitespace-nowrap">NAME</th>
                                    <th class="text-center whitespace-nowrap">PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlists as $index=>$item)
                                    <tr class="intro-x">
                                        <td class="text-center w-20"> {{ $wishlists->firstItem() + $loop->index }} </td>
                                        <td class="text-center">{{ $item->product->product_code }}</td>
                                        <td class="w-32">
                                            <img class="rounded-md w-full aspect-[4/3] object-cover"
                                                src="{{ asset($item->product->images->count() ? 'storage/' . $item->product->images->first()->thumb : 'dist/images/placeholders/no-image.jpg') }}"
                                                alt="{{ $item->product->images->count() ? $item->product->images->first()->alt : 'product_image' }}">
                                        </td>
                                        <td class="text-center">
                                            <p class="font-medium whitespace-nowrap">{{ $item->product->name }}
                                            </p>
                                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                                {{ $item->product->category->name }}
                                            </div>
                                        </td>
                                        <td class="text-center">{{ pricing($item->product->price) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="6">No Data</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!-- BEGIN: Pagination -->
                    <div
                        class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap justify-end items-center mt-8">
                        {{ $wishlists->links('fragments.pagination') }}
                    </div>
                    <!-- END: Pagination -->
                </div>
                <!-- END: Customer's Wishlist -->
            </div>

        </div>
    </div>
    {{-- <!-- BEGIN: Customer's Wishlist -->
    <div class="mt-8 intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-hover -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-nowrap">NO</th>
                    <th class="text-center whitespace-nowrap">PRODUCT CODE</th>
                    <th class="text-center whitespace-nowrap">IMAGE</th>
                    <th class="text-center whitespace-nowrap">NAME</th>
                    <th class="text-center whitespace-nowrap">PRICE</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wishlists as $index=>$item)
                    <tr class="intro-x">
                        <td class="text-center w-20"> {{ $wishlists->firstItem() + $loop->index }} </td>
                        <td class="text-center">{{ $item->product->product_code }}</td>
                        <td class="w-32">
                            <img class="rounded-md w-full aspect-[4/3] object-cover"
                                src="{{ asset($item->product->images->count() ? 'storage/' . $item->product->images->first()->thumb : 'dist/images/placeholders/no-image.jpg') }}"
                                alt="{{ $item->product->images->count() ? $item->product->images->first()->alt : 'product_image' }}">
                        </td>
                        <td class="text-center">
                            <p class="font-medium whitespace-nowrap">{{ $item->product->name }}
                            </p>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                {{ $item->product->category->name }}
                            </div>
                        </td>
                        <td class="text-center">{{ pricing($item->product->price) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center text-muted" colspan="6">No Data</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div
        class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap justify-end items-center mt-8">
        {{ $wishlists->links('fragments.pagination') }}
    </div>
    <!-- END: Pagination --> --}}
@endsection
