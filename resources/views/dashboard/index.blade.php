@include('layout.head', ['title' => 'Dashboard'])
@include('layout.sidebar')
@include('layout.header')



<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="mb-0 alert alert-primary alert-dismissible fade show">Selamat datang, {{ Auth::user()->name }}!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-1">
            <h5 class="w-100">Fitur Pilihan</h5>

            <div class="col-6 col-md-6 col-xxl-2">
                <a href="{{ route('form-pengawas.index') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" alt="Form Pengawas" style="max-width: 20px">
                            <h6 class="card-title" style="font-size:12px">Laporan Harian</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-6 col-xxl-2">
                <a href="{{ route('production.index') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/production.png" alt="Produksi Per Jam" style="max-width: 20px">
                            <h6 class="card-title" style="font-size:12px">Produksi Per Jam</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-1">

            <h5 class="w-100">KLKH</h5>

            <div class="col-4 col-md-6 col-xxl-2">
                <a href="{{ route('klkh.loading-point') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="KLKH Loading Point" style="max-width: 20px">
                            <h6 class="card-title" style="font-size:10px">Loading Point</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-md-6 col-xxl-2">
                <a href="{{ route('klkh.haul-road') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="KLKH Haul Road" style="max-width: 20px">
                            <h6 class="card-title" style="font-size:12px">Haul Road</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-md-6 col-xxl-2">
                <a href="{{ route('klkh.disposal') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="KLKH Disposal" style="max-width: 20px">
                            <h6 class="card-title" style="font-size:12px">Disposal</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>



@include('layout.footer')
