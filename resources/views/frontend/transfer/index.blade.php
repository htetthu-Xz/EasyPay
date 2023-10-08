@extends('frontend.layouts.app')

@section('title', 'Transfer money')

@section('content')
<div class="transfer">
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="">From</label>
                <p class="mb-1 text-muted">{{ auth()->user()->name }}</p>
                <p class="mb-1 text-muted">{{ auth()->user()->phone }}</p>
            </div>

            <form action="{{ route('transfer.confirm') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
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
                </div>
    
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

@push('script')
    <script>
        $(() => {
            $('.btn-check-phone').on('click', function () {
                let value = $('.to_phone').val();
                $('.to').empty();
                $.ajax({
                    url : "{{ route('transfer.check.phone') }}",
                    type : 'GET',
                    data : {
                        'phone' : value
                    },
                    success : function(res) {
                        if(res.status == 'success') {
                            $('.to').removeClass('text-danger');
                            $('.to').addClass('text-success');
                            $('.to').append(`( ${res.data.name} <i class="fa-solid fa-user-check"></i> )`);
                        } else {
                            $('.to').removeClass('text-success');
                            $('.to').addClass('text-danger');
                            $('.to').append('( <i class="fa-solid fa-user-slash"></i> No Account )');
                        }
                    }
                })
            })
        })
    </script>
@endpush
