@if (session('login'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Info!</strong>
        {{ session('login') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
