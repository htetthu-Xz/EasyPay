@extends('frontend.layouts.app')

@section('title', 'Receive QR')

@section('content')
    <div class="receive-qr">
        <div class="card">
            <div class="card-body">
                <p class="text-center mb-0">
                    Scan QR to pay me
                </p>
                <div class="text-center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate(auth()->user()->phone)) !!} ">
                </div>
                <p class="text-center mb-1">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-center mb-1">
                    {{ auth()->user()->phone }}
                </p>
            </div>
        </div>
    </div>
@endsection