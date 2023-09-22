@extends('backend.layouts.app')

@section('title', 'Admin Create')

@section('page_title', 'Admin Create')

@section('content')
    <div class="mb-4 text-end">
        <a href="{{ route('admin-user.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
    </div>
    <div class="content-section">
        <div class="card">
            <div class="card-body">
                @include('backend.layouts.page_info')
                <form action="{{ route('admin-user.store') }}" method="POST" id="create">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <button class="btn btn-secondary mx-3 cancel-btn">Cancel</button>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! JsValidator::formRequest('App\Http\Requests\AdminUserRequest', '#create') !!}
@endpush