@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="p-5">
        <div class="intro-y flex items-center mt-3">
            <h2 class="text-lg font-medium mr-auto">
                Product Detail
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <div class="intro-y box p-5">
                    <div class="flex flex-col md:flex-row gap-5">
                        {{-- Product Images --}}
                        <div class="px-2 py-1 md:p-0.5 md:basis-1/3 justify-center items-center">
                            <div>
                                <img class="product-image"
                                    src="{{ asset($product->images->count() ? 'storage/' . $product->images->first()->src : 'dist/images/placeholders/no-image.jpg') }}"
                                    alt="{{ asset($product->images->count() ? 'storage/' . $product->images->first()->alt : 'no-image') }}">
                            </div>
                            <div class="slider-wrapper mt-5 gap-2">
                                <i id="arrow-left" class="w-8 h-8" data-lucide="chevron-left"></i>
                                <div id="thumbnail-slider" class="thumbnail-slider">
                                    @foreach ($product->images as $index => $image)
                                        <img class="product-thumbnail {{ $index == 0 ? 'active-thumbnail' : '' }}"
                                            src="{{ asset('storage/' . $image->src) }}"
                                            alt="product-image-{{ $loop->iteration }}">
                                    @endforeach
                                </div>
                                <i id="arrow-right" class="w-8 h-8" data-lucide="chevron-right"></i>

                            </div>
                        </div>
                        {{-- Product Images --}}

                        {{-- Product Info --}}
                        <div class="md:basis-2/3">
                            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                            <h4 class="font-medium text-sm">
                                <span>Liked by</span>
                                <span id="likes_{{ 0 }}"
                                    class="mx-0.5">{{ $product->wishlists->count() }}</span>
                                <span>{{ $product->wishlists->count() > 1 ? 'users' : 'user' }}</span>
                            </h4>
                            <h4 class="font-bold text-primary text-base">
                                {{ pricing($product->price) }}</h4>
                            <div class="mt-2">{{ strip_tags($product->description) }}</div>
                            <hr class="mt-0.5">
                            <div class="w-full md:w-1/2 mt-3">
                                <div class="flex flex-row gap-1">
                                    <div class="basis-1/3">Category</div>
                                    <div class="basis-2/3">{{ ': ' . $product->category->name }}</div>
                                </div>
                                <div class="flex flex-row gap-1">
                                    <div class="basis-1/3">Dimensions</div>
                                    <div class="basis-2/3">{{ ': ' . $product->dimensions }}</div>
                                </div>
                                <div class="flex flex-row gap-1">
                                    <div class="basis-1/3">Materials</div>
                                    <div class="basis-2/3">{{ ': ' . $product->materials }}</div>
                                </div>
                                <div class="flex flex-row gap-1">
                                    <div class="basis-1/3">Color</div>
                                    <div class="basis-2/3">{{ ': ' . $product->color }}</div>
                                </div>
                                @if (isset($product->link_shopee))
                                    <a href="{{ $product->link_shopee }}"
                                        class="btn btn-primary text-light btn-sm mt-2"><img class="w-5 mr-1"
                                            src="{{ asset('dist/images/icon/shopee_logo.png') }}"
                                            alt="icon"></i>Available
                                        on Shopee</a>
                                @else
                                    <button disabled="disabled" class="btn btn-primary text-light btn-sm mt-2">Not Available
                                        on Shopee</button>
                                @endif
                                {{-- <a href="{{ $product->link_shopee ?? '#' }}"
                                    class="btn btn-primary text-light btn-sm mt-2"><i data-lucide="shopping-bag"
                                        class="w-5 mr-1"></i>{{ $product->link_shopee ? 'Available on Shopee' : 'Not Available on Shopee' }}</a> --}}
                            </div>

                        </div>
                        {{-- Product Info --}}
                    </div>
                    <div class="text-right mt-8">
                        <a class="btn btn-outline-primary w-24 mr-1"
                            href="{{ route('manage_product.update', ['product' => $product]) }}">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                        <a class="btn btn-outline-danger w-24" href="javascript:;" data-tw-toggle="modal"
                            data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler(0)">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                        <input type="hidden" id="delete_route_0"
                            value="{{ route('manage_product.delete', ['product' => $product]) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete these records?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 flex justify-center items-center">
                        <button type="button" data-tw-dismiss="modal"
                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <form id="deleteItem" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="ml-2 btn btn-danger text-danger w-24 ">Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection
@section('script')
    <script src="{{ asset('dist/js/view/dashboard/manage-product.js') }}"></script>
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
