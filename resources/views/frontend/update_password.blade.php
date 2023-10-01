@extends('frontend.layouts.app')

@section('title', 'Update Password')

@section('content')
    <div class="update-password">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('images/img/update_password.png') }}" alt="">
                </div>
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @if (session()->has('message'))
                        <div class="alert alert-danger alert-dismissible p-2 fade show" role="alert">
                            <p class="mb-0 d-inline align-middle mx-2">{{ session('message') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group mb-3">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control shadow-none mt-2 @error('old_password') is-invalid @enderror" name="old_password" id="old_password">
                    
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control shadow-none mt-2 @error('new_password') is-invalid @enderror" name="new_password" id="new_password">
                        
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-theme w-100 mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
