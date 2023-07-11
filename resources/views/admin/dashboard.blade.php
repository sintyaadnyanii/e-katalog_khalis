@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="relative">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 2xl:col-span-9">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                General Report
                            </h2>
                            <a href="{{ route('dashboard') }}" class="ml-auto flex items-center text-primary"> <i
                                    data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6 xl:col-span-4 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-lucide="globe" class="report-box__icon text-primary"></i>
                                        </div>
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $totalVisitors }}</div>
                                        <div class="text-base text-slate-500 mt-1">Visitors</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 xl:col-span-4 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-lucide="users" class="report-box__icon text-pending"></i>
                                        </div>
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countCustomers }}</div>
                                        <div class="text-base text-slate-500 mt-1">Registered Customers</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 xl:col-span-4 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-lucide="package" class="report-box__icon text-warning"></i>
                                        </div>
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countProducts }}</div>
                                        <div class="text-base text-slate-500 mt-1">Total Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: General Report -->
                    <!-- BEGIN: Top Liked Products -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Top 10 Most Liked Products
                            </h2>
                            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0 gap-2">
                                <h2>Sort by Month: </h2>
                                <div class="rounded-md shadow text-slate-500 bg-white">
                                    <form action="{{ route('dashboard') }}" method="get" class="flex items-center">
                                        <input type="month" name="month"
                                            class="py-1.5 w-20 md:w-44 border-0 shadow-none text-sm rounded-l-md focus:ring-0"
                                            id="monthInput">
                                        <button type="submit" class="py-1.5 px-1 border-s"><i data-lucide="search"
                                                class="w-4 stroke-slate-700"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-2">
                            <table class="table table-report">
                                <thead>
                                    <tr>
                                        <th class="text-center whitespace-nowrap">NO</th>
                                        <th class="text-center whitespace-nowrap">PRODUCT CODE</th>
                                        <th class="text-center whitespace-nowrap">IMAGE</th>
                                        <th class="text-center whitespace-nowrap">NAME</th>
                                        <th class="text-center whitespace-nowrap">PRICE</th>
                                        <th class="text-center whitespace-nowrap">LIKES</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($top_products as $index=>$item)
                                        <tr class="intro-x">
                                            <td class="text-center w-20"> {{ $loop->iteration }}
                                            </td>
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
                                            <td class="text-center">{{ $item->wishlists->count() }}</td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center items-center gap-3">
                                                    <a class="flex items-center"
                                                        href="{{ route('manage_product.detail', ['product' => $item]) }}">
                                                        <i data-lucide="view" class="w-4 h-4 mr-1"></i> Detail </a>
                                                    <a class="flex items-center"
                                                        href="{{ route('manage_product.update', ['product' => $item]) }}">
                                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                                    <a class="flex items-center text-danger" href="javascript:;"
                                                        data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"
                                                        onclick="deleteModalHandler({{ $index }})"> <i
                                                            data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                                    <input type="hidden" id="delete_route_{{ $index }}"
                                                        value="{{ route('manage_product.delete', ['product' => $item]) }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="7">No Data</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END: Weekly Top Products -->
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
    <script>
        $(document).ready(function() {
            var monthValue = "{{ request('month', null) }}";
            if (monthValue !== 'null') {
                $("#monthInput").val(monthValue);
            }
        })
    </script>
    <script src="{{ asset('dist/js/view/dashboard/manage-product.js') }}"></script>
@endsection
