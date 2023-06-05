@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">Feedback</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('manage_feedback.create') }}" class="btn btn-primary shadow-md mr-2">Add New Feedback</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="new-form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div> --}}
        <div class="intro-y col-span-12 flex flex-row justify-between items-center mt-2">
            <a href="{{ route('manage_feedback.create') }}" class="btn btn-primary shadow-md mr-2">Add New Feedback</a>
            <div class="rounded-md shadow text-slate-500 bg-white">
                <form action="{{ route('manage_feedback.all') }}" method="get" class="flex items-center">
                    <input type="text" name="search"
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
                        <th class="text-center whitespace-nowrap">FEEDBACK</th>
                        <th class="text-center whitespace-nowrap">DATE</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($feedbacks as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20"> {{ $feedbacks->firstItem() + $loop->index }} </td>
                            <td class="text-center">
                                <p class="font-medium whitespace-nowrap">{{ $item->user->name ?? 'anonymous' }}</p>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{ $item->user->email ?? 'unknown' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="font-medium whitespace-nowrap inline-flex items-center">{{ $item->rating }}/5<i
                                        data-lucide="star" class="active w-4 ml-0.5 -mt-0.5"></i>
                                </div>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{ Str::words(html_entity_decode(strip_tags($item->message)), 10, '...') }}</div>
                            </td>
                            <td class="text-center">
                                {{ date_format($item->created_at, 'd M Y') }}
                            </td>
                            <td class="text-center">
                                {{ $item->status ? 'Reviewed' : 'Unreviewed' }}
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center gap-3">
                                    <a class="flex items-center justify-center"
                                        href="{{ route('manage_feedback.detail', ['feedback' => $item]) }}"> <i
                                            data-lucide="view" class="w-4 h-4 mr-1"></i> Detail </a>
                                    <form action="{{ route('manage_feedback.patch', ['feedback' => $item]) }}"
                                        method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" value="{{ $item->status }}" name="status">
                                        <button class="flex items-center justify-center">
                                            <i data-lucide="{{ $item->status ? 'x-square' : 'check-square' }}"
                                                class="w-4 h-4 mr-1"></i> {{ $item->status ? 'Unreviewed' : 'Reviewed' }}
                                        </button>
                                    </form>
                                    <a class="flex items-center text-danger justify-center" href="javascript:;"
                                        data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"
                                        onclick="deleteModalHandler({{ $index }})"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                    <input type="hidden" id="delete_route_{{ $index }}"
                                        value="{{ route('manage_feedback.delete', ['feedback' => $item]) }}">
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="5">No Data</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap justify-end items-center">
            {{ $feedbacks->links('fragments.pagination') }}
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
    <script src="{{ asset('dist/js/view/dashboard/manage-feedback.js') }}"></script>
@endsection
