@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">Categories</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="#" class="btn btn-primary shadow-md mr-2">Send Notification</a>
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
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
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
                        <th class="text-center whitespace-nowrap">ADDRESS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20"> {{ $loop->iteration }} </td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->phone }}</td>
                            <td class="text-center">{{ $item->email }}</td>
                            <td class="text-center">{{ $item->address ?? 'unknown' }}</td>
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
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevrons-left"></i> </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-left"></i> </a>
                    </li>
                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                    <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
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
{{-- @section('script')
    <script src="{{ asset('dist/js/view/dashboard/manage-user.js') }}"></script>
@endsection --}}
