@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="p-5">
        <div class="intro-y flex items-center mt-3">
            <h2 class="text-lg font-medium mr-auto">
                Update Category
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_category.patch', ['category' => $category]) }}" method="post">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}">
                    <div class="intro-y box p-5">
                        <div>
                            <label for="name" class="form-label">Category Name</label>
                            @error('name')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="category_name" name="name" type="text" class="form-control w-full"
                                placeholder="Input text" value="{{ old('name') ?? $category->name }}"
                                onchange="getSlug(this.value)">
                        </div>
                        <div>
                            <label for="slug" class="form-label mt-3">Slug</label>
                            @error('slug')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="category_slug" name="slug" type="text" class="form-control w-full"
                                placeholder="Slug will be generated automatically"
                                value="{{ old('slug') ?? $category->slug }}"readonly>
                        </div>

                        <div>
                            <label for="description" class="form-label mt-3">Description</label>
                            @error('description')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <textarea id="description" name="description" type="text" class="form-control w-full"
                                placeholder="Input category description">{!! old('description') ?? $category->description !!}</textarea>
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_category.all') }}"
                                class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
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
    <script src="{{ asset('dist/js/view/manage-all.js') }}"></script>
@endsection
