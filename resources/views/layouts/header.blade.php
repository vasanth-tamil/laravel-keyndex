<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    @yield('header-title', 'Keyndex')
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#"
                        class="shadow-none btn bg-transparent border-1 border-secondary text-secondary d-none d-sm-inline-block"
                        onclick="toggleTheme()">
                        <i class="ti ti-brightness"></i>
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
                        <i class="ti ti-plus"></i>
                    </a>
                    @section('header-actions')

                    @show
                </div>
            </div>
        </div>
    </div>
</div>
