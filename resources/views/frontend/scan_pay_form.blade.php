@extends('frontend.layouts.app')

@section('title', 'Transfer money')

@section('content')
<div class="transfer">
    <div class="card">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-danger alert-dismissible p-2 fade show" role="alert">
                    <p class="mb-0 d-inline align-middle mx-2">{{ session('message') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group mb-3">
                <label for="">From</label>
                <p class="mb-1 text-muted">{{ auth()->user()->name }}</p>
                <p class="mb-1 text-muted">{{ auth()->user()->phone }}</p>
            </div>

            <form action="{{ route('transfer.confirm') }}" method="POST">
                @csrf
                {{-- <div class="form-group mb-3">
                    <label for="">Transfer to phone number <span class="to"></span></label>
                    <div class="input-group">
                        <input type="text" class="form-control to_phone shadow-none @error('to_phone') is-invalid @enderror" name="to_phone" value="{{ old('to_phone') }}">
                        <span class="input-group-text btn btn-check-phone"><i class="fa-solid fa-circle-check mx-2"></i></span>
                        @error('to_phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="form-group mb-3">
                    <label for="">Transfer to phone number </label>
                    <p class="mb-1 text-muted">{{ $to_account->name }}</p>
                    <p class="mb-1 text-muted">{{ $to_account->phone }}</p>
                </div>

                <input type="hidden" name="to_phone" value="{{ $to_account->phone }}">
    
                <div class="form-group mb-3">
                    <label for="">Amount</label>
                    <input type="text" class="form-control shadow-none mt-1 @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
                    
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control shadow-none mt-1" name="description">{{ old('description') }}</textarea>
                </div>
    
                <button type="submit" class="btn btn-theme w-100 mt-3">Continue</button>
            </form>
        </div>
    </div>
</div>
@endsection