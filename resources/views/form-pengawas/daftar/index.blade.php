@include('layout.head', ['title' => 'Daftar Laporan'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li> --}}
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Daftar Laporan Pengawas</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 row d-flex align-items-center">
                            <div class="col-sm-12 col-md-10 mb-2">
                                <form action="" method="get">
                                    <div class="input-group" id="pc-datepicker-10">
                                        <input type="text" class="form-control form-control-sm" placeholder="Start date" name="rangeStart" style="max-width: 200px;" id="range-start">
                                        <span class="input-group-text">s/d</span>
                                        <input type="text" class="form-control form-control-sm" placeholder="End date" name="rangeEnd" style="max-width: 200px;" id="range-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                    </div>
                                </form>
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
                            <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">Shift</th>
                                        <th rowspan="2">Area</th>
                                        <th rowspan="2">Unit Kerja</th>
                                        <th rowspan="2">PIC</th>
                                        <th colspan="2">Foreman</th>
                                        <th colspan="2">Supervisor</th>
                                        <th colspan="2">Superintendent</th>
                                        <th rowspan="2">Draft</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($daily as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->shift }}</td>
                                            <td>{{ $item->area }}</td>
                                            <td>{{ $item->lokasi }}</td>
                                            <td>{{ $item->pic }}</td>
                                            <td>{{ $item->nik_foreman }}</td>
                                            <td>{{ $item->nama_foreman }}</td>
                                            <td>{{ $item->nik_supervisor }}</td>
                                            @if ($item->verified_supervisor == null)
                                                <td>{{ $item->nama_supervisor }} <span class="badge bg-danger">Unverified</span></td>
                                            @else
                                                <td>{{ $item->nama_supervisor }} <span class="badge bg-success">Verified</span></td>
                                            @endif
                                            <td>{{ $item->nik_superintendent }}</td>
                                            @if ($item->verified_superintendent == null)
                                                <td>{{ $item->nama_superintendent }} <span class="badge bg-danger">Unverified</span></td>
                                            @else
                                                <td>{{ $item->nama_superintendent }} <span class="badge bg-success">Verified</span></td>
                                            @endif
                                            <td>{{ $item->is_draft == true ? "Ya" : "Tidak" }}</td>
                                            <td>
                                                <a href="{{ route('form-pengawas-old.download', $item->uuid) }}" target="_blank"><span class="badge bg-primary"><i class="fas fa-print"></i> Cetak</span></a>
                                                <a href="{{ route('form-pengawas-old.preview', $item->uuid) }}"><span class="badge bg-success">Preview</span></a>
                                                @if (Auth::user()->role == 'ADMIN')
                                                    <a href="#"><span class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteLaporanKerja{{ $item->uuid }}"><i class="fas fa-trash-alt"></i> Hapus</span></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @include('form-pengawas-old.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
<script>
    // range picker
    (function () {
        const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-10'), {
            buttonClass: 'btn'
        });
    })();

</script>

