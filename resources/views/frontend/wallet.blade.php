@extends('frontend.layouts.app')

@section('title', 'Wallet')

@section('content')
    <div class="wallet">
        <div class="card wallet-card">
            <div class="card-body">
                <div class="mb-3">
                    <span>Balance</span>
                    <h4>{{ number_format(auth()->user()->Wallet ? auth()->user()->Wallet->amount : '0', 2) }} <span class="currency">MMK</span></h4>
                </div>
                <div class="mb-4">
                    <span>Account Number</span>
                    <h5>{{ auth()->user()->Wallet ? auth()->user()->Wallet->account_number : '-' }}</h5>
                </div>
                <div>
                    <p>{{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
