@extends('frontend.layouts.app')

@section('title', 'Update Password')

@section('content')
    <div class="update-password">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('images/img/update_password.png') }}" alt="">
                </div>
                <div class="form-group mb-3">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control mt-2" name="old_password" id="old_password">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control mt-2" name="new_password" id="new_password">
                </div>
                <button class="btn btn-theme w-100 mt-4">Update</button>
            </div>
        </div>
    </div>
@endsection
