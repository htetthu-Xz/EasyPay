@extends('frontend.layouts.app')

@section('title', 'Transfer Confirmation')

@section('content')
<div class="transfer">
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-2">
                <label for="" class="mb-0"><strong>From</strong></label>
                <p class="mb-0 text-muted">{{ auth()->user()->name }}</p>
                <p class="mb-0 text-muted">{{ auth()->user()->phone }}</p>
            </div>

            <form action="{{ route('transfer.confirm') }}" method="GET">
                <div class="form-group mb-2">
                    <label for="" class="mb-0"><strong>To</strong></label>
                    <p class="text-muted mb-1">
                        {{ $attributes['to_phone'] }}
                    </p>
                </div>
    
                <div class="form-group mb-2">
                    <label for="" class="mb-0"><strong>Amount</strong></label>
                    <p class="text-muted mb-1">
                        {{ number_format($attributes['amount']) }} MMK
                    </p>
                </div>
    
                <div class="form-group">
                    <label for="" class="mb-0"><strong>Description</strong></label>
                    <p class="text-muted mb-1">
                        {{ $attributes['description'] }}
                    </p>
                </div>
    
                <button type="submit" class="btn btn-theme w-100 mt-3">Continue</button>
            </form>
        </div>
    </div>
</div>
@endsection
