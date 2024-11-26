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

        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h5 class="mb-0">Daftar yang sudah mengisi laporan harian</h5>
                        {{-- <button class="btn btn-sm btn-link-primary">Lihat semua</button> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        {{-- <th>Tanggal</th>
                                        <th>Shift</th>
                                        <th>Area</th>
                                        <th>Lokasi</th> --}}
                                        <th>Jumlah</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daily as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0"><img src="{{ asset('dashboard/assets/images/user/' . ($item->avatar !== null ? $item->avatar : 'avatar-1') . '.jpg') }}" alt="user image" class="img-radius wid-40"></div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-0">{{ $item->nik }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->role }}</td>
                                            {{-- <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->shift }}</td>
                                            <td>{{ $item->area }}</td>
                                            <td>{{ $item->lokasi }}</td> --}}
                                            <td><span class="badge text-bg-success">{{ $item->jumlah }}</span></td>
                                            <td class="text-end"><a href="#" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-20"></i></a></td>
                                                        {{-- <a href="#"
                                                    class="avtar avtar-xs btn-link-secondary"><i
                                                        class="ti ti-edit f-20"></i> </a><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary"><i
                                                        class="ti ti-trash f-20"></i></a> --}}

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layout.footer')
