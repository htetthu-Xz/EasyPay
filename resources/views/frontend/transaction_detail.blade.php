@extends('frontend.layouts.app')

@section('title', 'Transaction Details')

@section('content')
    <div class="transaction-detail">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('images/img/transaction_3.png') }}" alt="">
                </div>
                <h6 class="text-center mb-4 {{ $transaction->type == 1 ? 'text-success' : 'text-danger' }}">
                    {{ $transaction->type == 1 ? '+' : '-' }}
                    {{ number_format($transaction->amount) }}
                    <small>MMK</small>
                </h6>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">Trx ID</p>
                    <p class="mb-0">{{ $transaction->trx_id }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">Reference Number</p>
                    <p class="mb-0">{{ $transaction->ref_no }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">Transaction Time</p>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/y H:i:s') }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">Type</p>
                    <p class="mb-0">
                        <span class="badge rounded-pill {{ $transaction->type == 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                            {{ $transaction->type == 1 ? 'Income' : 'Expense' }}
                        </span>
                    </p>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">{{ $transaction->type == 1 ? 'From' : 'To' }}</p>
                    <p class="mb-0">{{ $transaction->Source->name }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">Amount</p>
                    <p class="mb-0">{{ number_format($transaction->amount, 2) }} <small>MMK</small></p>
                </div>

                @if ($transaction->description)

                <hr>

                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted">Description</p>
                    <p class="mb-0">{{ $transaction->description }}</p>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection