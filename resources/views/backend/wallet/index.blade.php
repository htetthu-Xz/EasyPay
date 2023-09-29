@extends('backend.layouts.app')

@section('title', 'Wallets')

@section('content')

    <div class="section d-block">
        <div class="card d-block">
            <div class="card-body">
                <table class="table data-table table-bordered w-100">
                    <thead>
                        <th class="text-center">Account Number</th>
                        <th class="text-center">Account Person</th>
                        <th class="text-center">Amount (MMK)</th>
                        <th class="text-center">Created at</th>
                        <th class="text-center">Updated at</th>
                    </thead>
                    <tbody>
                        {{-- Datatable Data --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
    
@push('script')
    <script>
        $(() => {
            let table = $('.data-table').DataTable({
                serverSide : true,
                processing : true,
                ajax : "{{ route('wallets.serve-side.data') }}",
                scrollX : false,
                columns : [
                    {
                        data : 'account_number',
                        name : 'account_number',
                        class : 'text-center'
                    },
                    {
                        data : 'account_person',
                        name : 'account_person',
                    },
                    {
                        data : 'amount',
                        name : 'amount',
                        class : 'text-center'
                    },
                    {
                        data : 'created_at',
                        name : 'created_at',
                        class : 'text-center',
                        searchable : false,
                        sortable : false
                    },
                    {
                        data : 'updated_at',
                        name : 'updated_at',
                        class : 'text-center',
                        searchable : false
                    },
                ],
                order : [
                    [4, "desc"]
                ],
            });
        })
    </script>

@endpush
    