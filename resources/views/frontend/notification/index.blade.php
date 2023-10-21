@extends('frontend.layouts.app')

@section('title', 'Notification')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="noti">
        <div class="infinite-scroll">
            @foreach ($notifications as $notification)
                <a href="{{ route('notification.detail', $notification->id) }}">
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{ Str::limit($notification->data['title'], 40) }}</h6>
                                @if ($notification->read_at == null)
                                    <i class="fa-solid fa-bell text-danger"></i>
                                @endif
                            </div>
                            <p class="mb-1 text-muted">
                                {{ Str::limit($notification->data['message'], 100) }}
                            </p>
                            <p class="mb-1 text-muted">
                                {{ Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A') }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach

            <div class="d-flex justify-content-end mt-3">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/jscroll.min.js') }}"></script>

    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="text-center"><img class="center-block" src="/images/loading.gif" alt="Loading..." /></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endpush
