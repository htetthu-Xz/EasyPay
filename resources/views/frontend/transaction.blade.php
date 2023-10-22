@extends('frontend.layouts.app')

@section('title', 'Transaction')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="transaction">
        <div class="card mb-2">
            <div class="card-body p-2">
                <h6><i class="fa-solid fa-filter mx-2"></i>Filter</h6>
                <div class="row my-2">
                    <div class="col-6">
                        <div class="input-group">
                            <label class="input-group-text p-1">Date</label>
                            <input type="text" class="form-control date" placeholder="All">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <label class="input-group-text p-1">Type</label>
                            <select class="form-select type shadow-none">
                                <option value="">All</option>
                                <option value="1">Income</option>
                                <option value="2">Expense</option>
                            </select>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
        <div class="infinite-scroll">
            @foreach ($transactions as $transaction)
                <a href="{{ route('transaction.detail', $transaction->trx_id) }}">
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Trx id : {{ $transaction->trx_id }}</h6>
                                <p class="mb-1 {{ $transaction->type == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->type == 1 ? '+' : '-' }}
                                    {{ number_format($transaction->amount) }} 
                                    <small>MMK</small>
                                </p>
                            </div>
                            <p class="mb-1 text-muted">
                                {{ $transaction->type == 1 ? 'From' : 'To' }}
                                {{ $transaction->Source->name }}
                            </p>
                            <p class="mb-1 text-muted">
                                {{ $transaction->created_at }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach

            <div class="d-flex justify-content-end mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/jscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="text-center"><img class="center-block" src="/images/loading.gif" alt="Loading..." /></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });

            $('.type').on('change',  () => {
                let type = $('.type').val();
                let date = $('.date').val();
                history.pushState(null, '', `?type=${type}&date=${date}`)
                window.location.reload();
            })

            $('.date').daterangepicker({
                "singleDatePicker": true,
                "autoApply": false,
                "locale": {
                    "format": "YYYY-MM-DD",
                },
            });

            $('.date').on('apply.daterangepicker', function(ev, picker) {
                let date = $('.date').val();
                let type = $('.type').val();
                history.pushState(null, '', `?type=${type}&date=${date}`)
                window.location.reload();
            });
        });
    </script>
@endpush