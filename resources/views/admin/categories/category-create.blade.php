@extends('layouts.dashboard-layout')
@section('dashboard-content')
<div class="p-5">
     <div class="intro-y flex items-center mt-3">
                    <h2 class="text-lg font-medium mr-auto">
                        Add New Category
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12">
                        <!-- BEGIN: Form Layout -->
                        <form action="{{ route('manage_category.store') }}" method="post">
                        @csrf
                        <div class="intro-y box p-5">
                            <div>
                                <label for="category_name" class="form-label">Category Name</label>
                                <input id="category_name" name="category_name" type="text" class="form-control w-full" placeholder="Input text">
                            </div>
                            <div>
                                <label for="category_description" class="form-label mt-3">Description</label>
                                <textarea id="category_description" name="category_description" type="text" class="form-control w-full" placeholder="Input text"></textarea>
                            </div>
                            <div class="text-right mt-5">
                                <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                <button type="submit" class="btn btn-primary w-24 text-primary">Save</button>
                            </div>
                        </div>
                        </form>
                        
                        <!-- END: Form Layout -->
                    </div>
                </div>
</div>
   
@endsection