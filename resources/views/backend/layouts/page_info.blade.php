@if ($errors->any())
    <div class="alert alert-danger mx-auto p-2">
        <ul class="mb-0 px-0 list-unstyled">
            @foreach ($errors->all() as $error)
                <li class="text-sm"><i class="fas fa-exclamation-circle mx-2"></i>{{ $error }}</li>
            @endforeach 
        </ul>
    </div>
@endif