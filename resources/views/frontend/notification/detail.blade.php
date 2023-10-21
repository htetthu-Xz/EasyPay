@extends('frontend.layouts.app')

@section('title', 'Notification Details')

@section('content')
    <div class="noti-detail">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('images/img/notifications.png') }}" alt="">
                </div>
                <h5 class="text-center mb-4">
                    {{ $notification->data['title'] }}
                </h5>

                <p class="mb-1 text-muted">{{ $notification->data['message'] }}</p>
                <p class="mb-1"><small>{{ Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A') }}</small></p>
                <div class="text-center mt-3">
                    <a href="{{ $notification->data['link'] }}" class="btn btn-theme btn-sm">Continue</a>
                </div>

            </div>
        </div>
    </div>
@endsection