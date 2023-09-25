@extends('backend.layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="mb-4 text-end">
        <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
    </div>
    <div class="content-section">
        <div class="card">
            <div class="card-body">
                @include('backend.layouts.page_info')
                <form action="{{ route('users.update', [$user->id]) }}" method="POST" id="form">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <button class="btn btn-secondary mx-3 cancel-btn">Cancel</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest', '#form') !!}
@endpush