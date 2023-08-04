@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">Products</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('manage_product.create') }}" class="btn btn-primary shadow-md mr-2">Add New Product</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="new-form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div> --}}
        <div class="intro-y col-span-12 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mt-2">
            <div class="flex items-center gap-2">
                <a href="{{ route('manage_product.create') }}" class="btn btn-primary">Add New Product</a>
                <div class="dropdown">
                    <button
                        class="dropdown-toggle rounded-md ring-offset-transparent ring-transparent shadow text-slate-600 bg-white flex items-center justify-center p-2 md:py-2 md:px-3"
                        aria-expanded="false" data-tw-toggle="dropdown"><i class="w-5 h-5" data-lucide="filter"></i><span
                            class="hidden md:flex md:ml-1">Filter By
                            Category</span>
                    </button>
                    <div class="dropdown-menu w-52">
                        <ul class="dropdown-content h-52 overflow-y-auto">
                            <li>
                                <a href="/dashboard/products"
                                    class="dropdown-item {{ request('category') == null ? 'bg-slate-200/60' : '' }}">All</a>
                            </li>
                            @foreach ($categories as $item)
                                <li>
                                    <a href="/dashboard/products?category={{ $item->slug }}"
                                        class="dropdown-item {{ request('category') == $item->slug ? 'bg-slate-200/60' : '' }}">{{ $item->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <a href="{{ route('manage_product.report') }}" target="_blank"
                    class="rounded-md ring-offset-transparent ring-transparent shadow text-slate-600 bg-white
                    sm:flex items-center justify-center p-2 md:py-2 md:px-3"><i
                        class="w-5 h-5" data-lucide="file-text"></i><span class="hidden md:flex md:ml-1">Export
                        PDF</span></a>
            </div>

            <div class="rounded-md ring-offset-transparent ring-transparent shadow text-slate-600 bg-white w-full sm:w-44">
                <form action="{{ route('manage_product.all') }}" method="get" class="flex items-center">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" id="searchInput"
                        class="w-full py-1.5 border-0 shadow-none rounded-l-md focus:ring-0 text-sm"
                        placeholder="Search...">
                    <button type="submit" class="py-1.5 px-1 border-s"><i data-lucide="search"
                            class="w-4 stroke-slate-700 text-center"></i></button>
                </form>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">PRODUCT CODE</th>
                        <th class="text-center whitespace-nowrap">IMAGE</th>
                        <th class="text-center whitespace-nowrap">NAME</th>
                        <th class="text-center whitespace-nowrap">PRICE</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20"> {{ $products->firstItem() + $loop->index }} </td>
                            <td class="text-center">{{ $item->product_code }}</td>
                            <td class="w-40">
                                <img class="rounded-md w-full aspect-[4/3] object-cover"
                                    src="{{ asset($item->images->count() ? 'storage/' . $item->images->first()->thumb : 'dist/images/placeholders/no-image.jpg') }}"
                                    alt="{{ $item->images->count() ? $item->images->first()->alt : 'product_image' }}">
                            </td>
                            <td class="text-center">
                                <p class="font-medium whitespace-nowrap">{{ $item->name }}
                                </p>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{ $item->category->name }}
                                </div>
                            </td>
                            <td class="text-center">{{ pricing($item->price) }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center gap-3">
                                    <a class="flex items-center"
                                        href="{{ route('manage_product.detail', ['product' => $item]) }}"> <i
                                            data-lucide="view" class="w-4 h-4 mr-1"></i> Detail </a>
                                    <a class="flex items-center"
                                        href="{{ route('manage_product.update', ['product' => $item]) }}"> <i
                                            data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"
                                        onclick="deleteModalHandler({{ $index }})"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                    <input type="hidden" id="delete_route_{{ $index }}"
                                        value="{{ route('manage_product.delete', ['product' => $item]) }}">
                                </div>
                            </td>
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
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap justify-end items-center">
            {{ $products->links('fragments.pagination') }}
        </div>
        <!-- END: Pagination -->

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
    <script>
        $(document).ready(function() {
            var searchValue = "{{ request('search', null) }}";
            if (searchValue !== 'null') {
                $("#searchInput").val(searchValue);
            }
        })
    </script>
    <script src="{{ asset('dist/js/view/dashboard/manage-product.js') }}"></script>
@endsection
