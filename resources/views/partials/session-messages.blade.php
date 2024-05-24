@if (session('message'))

<div class="alert alert-success alert-dismissible d-flex justify-content-center text-center fade show position-fixed w-75" role="alert" style="margin: 1rem 10% 0 10%">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('message') }}
</div>

@endif