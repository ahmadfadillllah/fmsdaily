@include('layout.head', ['title' => 'Alat Support'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Laporan Harian Pengawas (Alat Support)</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 row d-flex align-items-center">
                            <div class="col-sm-12 col-md-10 mb-2">
                                <div class="input-group" id="pc-datepicker-5">
                                    <input type="text" class="form-control form-control-sm" placeholder="Start date" name="range-start" style="max-width: 200px;" id="range-start">
                                    <span class="input-group-text">s/d</span>
                                    <input type="text" class="form-control form-control-sm" placeholder="End date" name="range-end" style="max-width: 200px;" id="range-end">
                                    <button type="button" class="btn btn-primary btn-sm">View Report</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 mb-2 text-md-end text-center">
                                <button type="button" class="btn btn-success w-100 w-md-auto">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="table-style-hover"
                                class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th rowspan="2">Tanggal Pelaporan</th>
                                        <th rowspan="2">Shift</th>
                                        <th rowspan="2">Area</th>
                                        <th rowspan="2">Lokasi</th>
                                        <th rowspan="2">Jenis Unit</th>
                                        <th rowspan="2">Nomor Unit</th>
                                        <th colspan="4">Operator</th>
                                        <th colspan="2">Foreman</th>
                                        <th colspan="2">Supervisor</th>
                                        <th colspan="2">Superintendent</th>
                                        <th colspan="4">HM</th>
                                        <th rowspan="2">Material</th>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Shift</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Awal</th>
                                        <th>Akhir</th>
                                        <th>Total</th>
                                        <th>Cash</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    <tr>
                                        <td>17-11-2024</td>
                                        <td>Malam</td>
                                        <td>SM-B1</td>
                                        <td>Loading Point</td>
                                        <td>0555S</td>
                                        <td>Abdul Wahab</td>
                                        <td>0175S</td>
                                        <td>Agustinus</td>
                                        <td>0112S</td>
                                        <td>Suroso</td>
                                        <td>08:00</td>
                                        <td>08:25</td>
                                        <td>Road maintenance setelah hujan</td>
                                    </tr>
                                    <tr>
                                        <td>17-11-2024</td>
                                        <td>Malam</td>
                                        <td>SM-B2</td>
                                        <td>Loading Point</td>
                                        <td>0555S</td>
                                        <td>Abdul Wahab</td>
                                        <td>0175S</td>
                                        <td>Agustinus</td>
                                        <td>0112S</td>
                                        <td>Suroso</td>
                                        <td>08:00</td>
                                        <td>08:25</td>
                                        <td>Road maintenance setelah hujan</td>
                                    </tr>

                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
