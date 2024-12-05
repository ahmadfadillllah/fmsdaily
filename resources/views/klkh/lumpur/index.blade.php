@include('layout.head', ['title' => 'KLKH Dumping di Kolam Air/Lumpur'])
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">KLKH</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Dumping di Kolam Air/Lumpur</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 row d-flex align-items-center">
                            <div class="col-sm-12 col-md-10 mb-2">
                                <form action="" method="get">
                                    <div class="input-group" id="pc-datepicker-8">
                                        <input type="text" class="form-control form-control-sm" placeholder="Start date" name="rangeStart" style="max-width: 200px;" id="range-start">
                                        <span class="input-group-text">s/d</span>
                                        <input type="text" class="form-control form-control-sm" placeholder="End date" name="rangeEnd" style="max-width: 200px;" id="range-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                    </div>
                                </form>
                            </div>
                            @if (Auth::user()->role != 'ADMIN')
                                <div class="col-sm-12 col-md-2 mb-2 text-md-end">
                                    <a href="{{ route('klkh.lumpur.insert') }}"
                                    class="btn btn-success w-auto w-md-auto ms-md-0">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            @endif
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
                                        <th>No</th>
                                        <th>Tanggal Pembuatan</th>
                                        <th>PIC</th>
                                        <th>Pit</th>
                                        <th>Shift</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($lumpur as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y H:i:s', strtotime($item->tanggal_pembuatan)) }}
                                            <td>{{ $item->pic }}</td>
                                            <td>{{ $item->pit }}</td>
                                            <td>{{ $item->shift }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                            <td>{{ date('H:i', strtotime($item->time)) }}</td>
                                            <td>
                                                {{-- <a href="#" class="btn btn-warning btn-sm">Edit</a> --}}
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLP{{$item->id}}">Hapus</a>
                                            </td>
                                        </tr>
                                        @include('klkh.lumpur.delete')
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
        const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-8'), {
            buttonClass: 'btn'
        });
    })();

</script>

