@extends('backend.layouts.app')

@section('title', 'Admins')

@section('content')

        <div class="mb-4 text-end">
            <a href="{{ route('admin-user.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Admin</a>
        </div>
        <div class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table data-table table-bordered">
                        <thead>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">IP</th>
                            <th class="text-center">User Agent</th>
                            <th class="text-center">Updated at</th>
                            <th class="text-center">Action</th>
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
                ajax : "{{ route('admin.admin-user.data') }}",
                scrollX : false,
                columns : [
                    {
                        data : 'name',
                        name : 'name'
                    },
                    {
                        data : 'email',
                        name : 'email'
                    },
                    {
                        data : 'phone',
                        name : 'Phone'
                    },
                    {
                        data : 'ip',
                        name : 'ip',
                        searchable : false,
                        sortable : false
                    },
                    {
                        data : 'user_agent',
                        name : 'user_agent',
                        class : 'text-center',
                        searchable : false,
                        sortable : false
                    },
                    {
                        data : 'updated_at',
                        name : 'updated_at',
                        searchable : false
                    },
                    {
                        data : 'action',
                        name : 'action',
                        searchable : false,
                        sortable : false
                    },
                ],
                order : [
                    [5, "desc"]
                ],
            });

            $(document).on('click', '.delete' ,function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure, you want to delete?',
                    confirmButtonText: 'Confirm',
                    confirmButtonColor: '#d9534f',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : route('admin-user.destroy', [$(this).data('id')]),
                            type : 'DELETE',
                            data : {
                            '_token' : "{{ csrf_token() }}",
                            },
                            success : function() {
                            table.ajax.reload();
                            }
                        })
                    }
                })
            });
        })
    </script>

@endpush
    