@extends('frontend.layouts.app')

@section('title', 'Transfer Confirmation')

@section('content')
<div class="transfer">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('transfer.complete') }}" id="con-form">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver_user->id }}">

                <div class="form-group mb-2">
                    <label for="" class="mb-0"><strong>From <span class="text-success">(<i class="fa-solid fa-user mx-1"></i>{{ auth()->user()->name }})</span></strong></label>
                    <p class="mb-0 text-muted">{{ auth()->user()->phone }}</p>
                </div>

                <div class="form-group mb-2">
                    <label for="" class="mb-0"><strong>To <span class="text-success">(<i class="fa-solid fa-user mx-1"></i>{{ $receiver_user->name }})</span></strong></label>
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
    
                <button type="submit" class="btn btn-theme w-100 confirm-btn mt-3">Confirm</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(() => {
            $('.confirm-btn').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Please fill your password.',
                    icon: 'info',
                    html: '<input type="password" class="form-control password text-center shadow-none" name="password" />',
                    showCloseButton: true,
                    showCancelButton: true,
                    reverseButtons: true,
                    focusConfirm: false,
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if(result.isConfirmed) {
                        let password = $('.password').val();
                        $.ajax({
                            url : "{{ route('transfer.check.password') }}",
                            type : 'GET',
                            data : {
                                'password' : password
                            },
                            success : function(res) {
                                if(res.status == 'success') {
                                    $('#con-form').submit();
                                } else {
                                    Swal.fire({
                                    icon: 'error',
                                    title: res.message,
                                    })
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush