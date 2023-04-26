@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="p-5">
        <div class="intro-y flex items-center mt-3">
            <h2 class="text-lg font-medium mr-auto">
                Update Product
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_product.patch', ['product' => $product]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="deleted_images" name="deleted_images">
                    <div class="intro-y box p-8">
                        <div class="mt-2">
                            <label for="category_id" class="form-label">Product Category</label>
                            @error('category_id')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input type="hidden" id="category_id" name="category_id" value="{{ $product->category_id }}">
                            <input type="text" class="form-control w-full" value="{{ $product->category->name }}"
                                readonly>
                        </div>
                        <div>
                            <label for="product_code" class="form-label mt-3">Product Code</label>
                            <input name="product_code" type="text" class="form-control w-full"
                                placeholder="Input Product Code" value="{{ $product->product_code }}" readonly>
                        </div>
                        <div>
                            <label for="name" class="form-label mt-3">Product Name</label>
                            @error('name')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="name" name="name" type="text" class="form-control w-full"
                                placeholder="Input Product Name" value="{{ old('name') ?? $product->name }}">
                        </div>
                        <div>
                            <label for="dimensions" class="form-label mt-3">Dimensions</label>
                            @error('dimensions')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="dimensions" name="dimensions" type="text" class="form-control w-full"
                                placeholder="Input Product's Dimensions"
                                value="{{ old('dimensions') ?? $product->dimensions }}">
                        </div>
                        <div>
                            <label for="materials" class="form-label mt-3">Materials</label>
                            @error('materials')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="materials" name="materials" type="text" class="form-control w-full"
                                placeholder="Input Product's Materials"
                                value="{{ old('materials') ?? $product->materials }}">
                        </div>
                        <div>
                            <label for="color" class="form-label mt-3">Color</label>
                            @error('color')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="color" name="color" type="text" class="form-control w-full"
                                placeholder="Input Product's Color" value="{{ old('color') ?? $product->color }}">
                        </div>
                        <div>
                            <label for="price" class="form-label mt-3">Price</label>
                            @error('price')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="price" name="price" type="text" class="form-control w-full"
                                placeholder="Input Product's Price" value="{{ old('price') ?? $product->price }}">
                        </div>

                        <div class="mt-2">
                            <label for="description" class="form-label mt-3">Description</label>
                            @error('description')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <textarea id="description" name="description" type="text" class="form-control"
                                placeholder="Input Product Description">{!! old('description') ?? $product->description !!}</textarea>
                        </div>
                        <div>
                            <label for="link_shopee" class="form-label mt-3">Shopee URL</label>
                            @error('link_shopee')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="link_shopee" name="link_shopee" type="url" class="form-control w-full"
                                placeholder="Input Product's URL"
                                value="{{ old('link_shopee') ?? $product->link_shopee }}">
                        </div>
                        <div class="input-container">
                            <div class="mb-3">
                                <label class="btn-upload btn btn-primary">
                                    <p id="btnLabel">Choose Image to Upload</p>
                                    <input type="file" name="images[]" multiple data-max_length="20"
                                        class="input-image">
                                </label>
                                @error('images.*')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                            </div>

                            <div class="images-container">
                                @foreach ($product->images as $item => $image)
                                    <div class="image-wrap">
                                        <div class="image-bg"
                                            style="background-image: url({{ asset('storage/' . $image->src) }})"
                                            data-number="{{ $item }}" data-id="{{ $image->id }}"
                                            data-file="{{ 'storage/' . $image->src }}">
                                            <div class="image-close">

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary text-primary w-24 ">Save</button>
                        </div>
                    </div>
                </form>

                <!-- END: Form Layout -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dist/js/view/dashboard/manage-product.js') }}"></script>
@endsection
