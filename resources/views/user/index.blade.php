@include('layout.head', ['title' => 'KLKH Loading Point'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $us)
                                    <tr>
                                        <td>
                                            <div class="row align-items-center">
                                                <div class="col-auto pe-0"><img src="{{ asset('dashboard/assets') }}/images/user/avatar-1.jpg" alt="user-image" class="wid-40 hei-40 rounded"></div>
                                                <div class="col">
                                                    <h6 class="mb-2"><span class="text-truncate w-100">{{ $us->name }}</span></h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-left f-w-600">{{ $us->nik }}</td>
                                        <td class="text-left f-w-600">{{ $us->role }}</td>
                                        <td>
                                            @if ($us->statusenabled == 'true')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-left f-w-600">
                                            <a href="#" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#resetPassword{{ $us->id }}">Reset Password</a>
                                            @if ($us->statusenabled == 'true')
                                                <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#statusEnabled{{ $us->id }}">Nonaktifkan</a>
                                            @else
                                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#statusEnabled{{ $us->id }}">Aktifkan</a>
                                            @endif

                                        </td>
                                    </tr>
                                    @include('user.modal.statusEnabled')
                                    @include('user.modal.resetPassword')
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
<script src="{{ asset('dashboard/assets') }}/js/plugins/simple-datatables.js"></script>
<script>
    const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
        sortable: false,
        perPage: 10
    });
</script>

