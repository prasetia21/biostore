@php
    $route = Route::current()->getName();
@endphp

<div class="col-md-12">
    <div class="dashboard-menu">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">BioPoint: {{ $userPoint }}<i class="fi-rs-money ml-10"></i></h5>
                <div class="mx-auto">
                    <button class="btn btn-primary mt-20" type="button">Rendeem Point</button>
                </div>
            </div>
        </div>
    </div>
</div>
