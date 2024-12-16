@include('layout.head', ['title' => 'KLKH OGS'])
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">OGS</a></li>
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
                                    <a href="{{ route('klkh.ogs.insert') }}"><span class="badge bg-success" style="font-size:14px"><i class="fas fa-plus"></i> Tambah Data</span></a>
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
                                        <th>Supervisor</th>
                                        <th>Superintendent</th>
                                        <th>Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($ogs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y H:i', strtotime($item->tanggal_pembuatan)) }}
                                            <td>{{ $item->pic }}</td>
                                            <td>{{ $item->pit }}</td>
                                            <td>{{ $item->shift }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                            <td>{{ date('H:i', strtotime($item->time)) }}</td>
                                            @if ($item->verified_supervisor == null)
                                                <td>{{ $item->nama_supervisor }} <span class="badge bg-danger">Unverified</span></td>
                                            @else
                                                <td>{{ $item->nama_supervisor }} <span class="badge bg-success">Verified</span></td>
                                            @endif
                                            @if ($item->verified_superintendent == null)
                                                <td>{{ $item->nama_superintendent }} <span class="badge bg-danger">Unverified</span></td>
                                            @else
                                                <td>{{ $item->nama_superintendent }} <span class="badge bg-success">Verified</span></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('klkh.ogs.preview', $item->uuid) }}" class="avtar avtar-s btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V7H5zm7-2q-2.05 0-3.662-1.112T6 13q.725-1.775 2.338-2.887T12 9t3.663 1.113T18 13q-.725 1.775-2.337 2.888T12 17m0-2.5q-.625 0-1.062-.437T10.5 13t.438-1.062T12 11.5t1.063.438T13.5 13t-.437 1.063T12 14.5m0 1q1.05 0 1.775-.725T14.5 13t-.725-1.775T12 10.5t-1.775.725T9.5 13t.725 1.775T12 15.5"/></svg>
                                                </a>
                                                <a href="#" class="avtar avtar-s btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteOGS{{$item->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 6v13zm4.25 15H7q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v4.3q-.425-.125-.987-.213T17 10V6H7v13h3.3q.15.525.4 1.038t.55.962M9 17h1q0-1.575.5-2.588L11 13.4V8H9zm4-5.75q.425-.275.963-.55T15 10.3V8h-2zM17 22q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m1.65-2.65l.7-.7l-1.85-1.85V14h-1v3.2z"/></svg>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('klkh.ogs.delete')
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

