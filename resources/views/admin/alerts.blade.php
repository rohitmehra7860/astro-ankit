<style>
    /* .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        left: 20px;
        z-index: 999;
    } */
</style>
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible show" role="alert" data-aos="fade-left">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible show" role="alert" data-aos="fade-left">
            <strong>{{ session('warning') }}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-left">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-left">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

</div>
