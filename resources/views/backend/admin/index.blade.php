@extends('backend.layouts.app')

@section('title', 'Admins')

@section('page_title', 'Admins')

@section('content')
    <div class="mb-4 text-end">
        <a href="{{ route('admin-user.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Admin</a>
    </div>
    <div class="content-section">
        <div class="card">
            <div class="card-body">
                <table class="table data-table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>IP</th>
                        <th>User Agent</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        {{-- Datetable Data --}}
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
                columns : [
                    {
                        data : 'id',
                        name : 'id'
                    },
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
                        name : 'ip'
                    },
                    {
                        data : 'user_agent',
                        name : 'user_agent',
                        class : 'text-center'
                    },
                    {
                        data : 'action',
                        name : 'action'
                    },
                ]
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
    