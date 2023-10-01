@extends('frontend.layouts.app')

@section('title', 'Easy Pay')

@push('css')
    <style>
        @media (max-width: 490px) {
            .app-name {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
<div class="home">
    <div class="d-flex">
        <div class="card mt-3 w-100">
            <div class="profile">
                <img src="https://ui-avatars.com/api/?background=405AA4&color=fff&name={{ str_replace(' ', '', auth()->user()->name) }}" alt="">
                <div>
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ number_format(auth()->user()->Wallet ? auth()->user()->Wallet->amount : '0', 2) }} MMK</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-6">
            <div class="card qr-box">
                <div class="card-body">
                    <img src="{{ asset('images/img/qr-scan.png') }}" alt="">
                    <span>Scan & Pay</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card qr-box">
                <div class="card-body">
                    <img src="{{ asset('images/img/qr-code.png') }}" alt="">
                    <span>Receive QR</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
