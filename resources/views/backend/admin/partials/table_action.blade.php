<a href="{{ route('admin-user.edit', [$admin->id]) }}" class="mx-2">
    <i class="far fa-edit"></i>
</a> 
\
<a href="#" class="mx-2 delete text-danger" data-id={{ $admin->id }} >
    <i class="fas fa-trash"></i>
</a>