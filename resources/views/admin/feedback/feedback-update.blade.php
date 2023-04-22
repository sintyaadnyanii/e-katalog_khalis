@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <div class="p-5">
        <div class="intro-y flex items-center mt-3">
            <h2 class="text-lg font-medium mr-auto">
                Update Feedback
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_feedback.patch', ['feedback' => $feedback]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="intro-y box p-8">
                        <div class="mt-2">
                            <label for="user_id" class="form-label">Customer
                                Name</label>
                            <select name="user_id" id="user_id" data-placeholder="Choose User" class="tom-select w-full">
                                <option value="0">Anonymous</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $feedback->user_id == $item->id ? 'selected' : null }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="rating" class="form-label mt-3">Rating</label>
                            <div class="flex gap-1">
                                <i data-lucide="star" class="star"></i>
                                <i data-lucide="star" class="star"></i>
                                <i data-lucide="star" class="star"></i>
                                <i data-lucide="star" class="star"></i>
                                <i data-lucide="star" class="star"></i>
                            </div>
                            <input id="rating" name="rating" type="hidden"
                                value="{{ old('rating') ?? $feedback->rating }}" placeholder="0/5">
                        </div>

                        <div class="mt-2">
                            <label for="message" class="form-label mt-3">
                                Message</label>
                            <textarea id="message" name="message" type="text" class="form-control" placeholder="Input Your Message">{!! $feedback->message ?? old('message') !!}</textarea>
                        </div>
                        <div class="my-2">
                            <label for="status" class="form-label mt-3">
                                Status</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="form-check mr-2"> <input id="status_show" class="form-check-input"
                                        type="radio" name="status" value="show"
                                        {{ $feedback->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_show">Show</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0"> <input id="status_hide" class="form-check-input"
                                        type="radio" name="status" value="hide"
                                        {{ $feedback->status ? '' : 'checked' }}>
                                    <label class="form-check-label" for="status_hide">Hide</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('manage_feedback.all') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
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
    <script src="{{ asset('dist/js/view/dashboard/manage-feedback.js') }}"></script>
@endsection
