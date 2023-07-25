@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">Customers</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-row justify-between items-center mt-2">
            <a href="{{ route('manage_customer.notification') }}" class="btn btn-primary shadow-md mr-2"><i data-lucide="bell"
                    class="w-4 h-4 mr-1"></i>Send
                Notification</a>
            <div class="rounded-md shadow text-slate-500 bg-white">
                <form action="{{ route('manage_customer.all') }}" method="get" class="flex items-center">
                    <input type="text" id="searchInput" name="search"
                        class="py-2 w-24 md:w-44 border-0 shadow-none rounded-l-md focus:ring-0" placeholder="Search...">
                    <button type="submit" class="py-2 px-1 border-s"><i data-lucide="search"
                            class="w-4 stroke-slate-700"></i></button>
                </form>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">NAME</th>
                        <th class="text-center whitespace-nowrap">PHONE NUMBER</th>
                        <th class="text-center whitespace-nowrap">EMAIL</th>
                        <th class="text-center whitespace-nowrap">CURRENT WISHLIST</th>
                        <th class="text-center whitespace-nowrap">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20"> {{ $customers->firstItem() + $loop->index }} </td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->phone }}</td>
                            <td class="text-center">{{ $item->email }}</td>
                            <td class="text-center">{{ $item->wishlists->count() }}</td>
                            <td class="table-report__action w-20">
                                <div class="flex justify-center items-center gap-3">
                                    <a class="flex items-center"
                                        href="{{ route('manage_customer.detail', ['user' => $item]) }}"> <i
                                            data-lucide="view" class="w-4 h-4 mr-1"></i> Detail </a>
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
            {{ $customers->links('fragments.pagination') }}
        </div>
        <!-- END: Pagination -->

    </div>
    {{-- <!-- BEGIN: Delete Confirmation Modal -->
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
    <!-- END: Delete Confirmation Modal --> --}}
@endsection
@section('script')
    {{-- <script src="{{ asset('dist/js/view/dashboard/manage-user.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            var searchValue = "{{ request('search', null) }}";
            if (searchValue !== 'null') {
                $("#searchInput").val(searchValue);
            }
        })
    </script>
@endsection
