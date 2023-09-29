@extends('frontend.layouts.app_plain')

@section('title', 'EasyPay Register')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Register</h3>
                        <p class="text-center text-muted">Fill the form to register.</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control mt-1 @error('name') is-invalid @enderror" name="name" id="name" autocomplete="false">
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control mt-1 @error('email') is-invalid @enderror" name="email" id="email" autocomplete="false">
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control mt-1 @error('phone') is-invalid @enderror" name="phone" id="phone" autocomplete="false">
                                
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control mt-1 @error('password') is-invalid @enderror" name="password"  autocomplete="false" id="password">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="con-password">Confirm Password</label>
                                <input type="password" class="form-control mt-1 @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="false" id="con-password">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary my-3 btn-block w-100">Register</button>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('register') }}">
                                    Alradsy have account? Login Here.
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
