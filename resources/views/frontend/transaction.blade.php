@extends('frontend.layouts.app')

@section('title', 'Transaction')

@section('content')
    <div class="transaction">
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
        });
    </script>
@endpush