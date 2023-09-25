
<a href="{{ route('users.edit', [$user->id]) }}" class="">
    <i class="far fa-edit"></i>
</a> 

<a href="#" class="mx-0 delete text-danger" data-id={{ $user->id }} >
    <i class="fas fa-trash"></i>
</a>
