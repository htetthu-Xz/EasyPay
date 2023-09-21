@if (session()->has('success'))

<script>
    Toastify({
        text: "{{ session('success') }}",
        duration: 4000,
        close:true,
        gravity:"top",
        position: "right",
        backgroundColor: "#4fbe87",
    }).showToast();
</script>
    
@endif