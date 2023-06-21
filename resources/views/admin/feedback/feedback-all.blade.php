@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">Feedback</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-col sm:flex-row sm:justify-between sm:items-center mt-2 gap-2">
            <div class="flex flex-row gap-2 sm:gap-1">
                <div class="dropdown w-1/2 md:w-fit">
                    <button class="dropdown-toggle btn btn-primary w-full" aria-expanded="false" data-tw-toggle="dropdown"> <i
                            data-lucide="filter" class="w-4 h-4 mr-2"></i>Sort By Status<i data-lucide="chevron-down"
                            class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="/dashboard/feedbacks" class="dropdown-item">All </a>
                            </li>
                            <li>
                                <a href="/dashboard/feedbacks?status=reviewed" class="dropdown-item">Reviewed
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/feedbacks?status=unreviewed" class="dropdown-item">Unreviewed </a>
                            </li>
                            <li>
                                <a href="/dashboard/feedbacks?status=replied" class="dropdown-item">Replied
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-1/2 md:w-40 rounded-md shadow text-slate-500 bg-white">
                    <form action="{{ route('manage_feedback.all') }}" method="get" class="flex items-center">
                        @if (request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        <input id="dateInput" type="date" name="date"
                            class="py-1.5 w-full border-0 shadow-none text-sm rounded-l-md focus:ring-0">
                        <button type="submit" class="py-1.5 px-1 border-s"><i data-lucide="search"
                                class="w-4 stroke-slate-700"></i></button>
                    </form>
                </div>
            </div>
            <div class="rounded-md shadow text-slate-500 bg-white w-full md:w-44">
                <form action="{{ route('manage_feedback.all') }}" method="get" class="flex items-center">
                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    @if (request('date'))
                        <input type="hidden" name="date" value="{{ request('date') }}">
                    @endif
                    <input type="text" name="search"
                        class="py-1.5 w-full border-0 shadow-none rounded-l-md focus:ring-0" placeholder="Search...">
                    <button type="submit" class="py-1.5 px-1 border-s"><i data-lucide="search"
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
                        <th class="text-center whitespace-nowrap">SENT DATE</th>
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
                                    {{ $item->user->email }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="font-medium whitespace-nowrap inline-flex items-center">{{ $item->rating }}/5<i
                                        data-lucide="star" class="fill-yellow-300 stroke-none w-4 ml-0.5 -mt-0.5"></i>
                                </div>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{ Str::words(html_entity_decode(strip_tags($item->message)), 10, '...') }}</div>
                            </td>
                            <td class="text-center">
                                {{ date_format($item->created_at, 'd M Y') }}
                            </td>
                            <td class="text-center capitalize">
                                {{ $item->status }}
                            </td>
                            <td class="table-report__action w-48">
                                <div class="flex justify-center items-center gap-3">
                                    <a class="flex items-center justify-center"
                                        href="{{ route('manage_feedback.detail', ['feedback' => $item]) }}"> <i
                                            data-lucide="view" class="w-4 h-4 mr-1"></i> Detail </a>
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
                            <td class="text-center text-muted" colspan="6">No Data</td>
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
    <script>
        $(document).ready(function() {
            var dateValue = "{{ request('date', null) }}";
            if (dateValue !== 'null') {
                $("#dateInput").val(dateValue);
            }
        })
    </script>
    <script src="{{ asset('dist/js/view/dashboard/manage-feedback.js') }}"></script>
@endsection
