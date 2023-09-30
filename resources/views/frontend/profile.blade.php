@extends('frontend.layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="account">
        <div class="profile mb-3">
            <img src="https://ui-avatars.com/api/?background=405AA4&color=fff&name={{ str_replace(' ', '', auth()->user()->name) }}" alt="">
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>User Name</span>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Email</span>
                    <span>{{ auth()->user()->email }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Phone</span>
                    <span>{{ auth()->user()->phone }}</span>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Update Password</span>
                    <span><i class="fa-solid fa-angle-right"></i></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Logout</span>
                    <span><i class="fa-solid fa-right-from-bracket"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection