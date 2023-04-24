@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="p-5">
        <div class="intro-y flex items-center mt-3">
            <h2 class="text-lg font-medium mr-auto">
                Feedback Detail
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <div class="intro-y box p-5">
                    <div class="flex flex-row gap-1">
                        <div class="basis-1/2 md:basis-1/4 font-medium">Customer Name</div>
                        <div class="basis-1/2 md:basis-3/4">{{ ': ' . $feedback->user->name }}</div>
                    </div>
                    <div class="flex flex-row gap-1 mt-2">
                        <div class="basis-1/2 md:basis-1/4 font-medium">Email</div>
                        <div class="basis-1/2 md:basis-3/4">{{ ': ' . $feedback->user->email }}</div>
                    </div>
                    <div class="flex flex-row gap-1 mt-2">
                        <div class="basis-1/2 md:basis-1/4 font-medium">Satisfaction Rate</div>
                        <div class="basis-1/2 md:basis-3/4 flex">{{ ': ' . $feedback->rating . '/5' }}<i data-lucide="star"
                                class="active w-4 ml-1 -mt-0.5"></i></div>
                    </div>
                    <div class="flex flex-row gap-1 mt-2">
                        <div class="basis-1/2 md:basis-1/4 font-medium">Message</div>
                        <div class="basis-1/2 md:basis-3/4">{{ ': ' . strip_tags($feedback->message) }}</div>
                    </div>
                    <div class="flex flex-row gap-1 mt-2">
                        <div class="basis-1/2 md:basis-1/4 font-medium">Status</div>
                        <div class="basis-1/2 md:basis-3/4">{{ $feedback->status == 'show' ? ': Shown' : ': Hidden' }}
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a class="btn btn-outline-primary w-24 mr-1"
                            href="{{ route('manage_feedback.update', ['feedback' => $feedback]) }}">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                        <a class="btn btn-outline-danger w-24" href="javascript:;" data-tw-toggle="modal"
                            data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler(0)">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                        <input type="hidden" id="delete_route_0"
                            value="{{ route('manage_feedback.delete', ['feedback' => $feedback]) }}">

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
    <script src="{{ asset('dist/js/view/dashboard/manage-feedback.js') }}"></script>
@endsection
