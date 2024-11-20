@if (session('success'))
    <script>
        Swal.fire(
        'Good job!',
        '{{ session('success') }}',
        'success'
        )
    </script>
@endif

@if (session('info'))
    <script>
        Swal.fire(
        'Upps!',
        '{{ session('info') }}',
        'info'
        )
    </script>
@endif
