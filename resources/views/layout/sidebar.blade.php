<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header"><a href="index.html" class="b-brand text-primary">
                <img src="{{ asset('dashboard/assets') }}/images/icon.png" class="img-fluid" width="100px" alt="logo">
                <span class="badge bg-light-success rounded-pill ms-2 theme-version">Laporan Pengawas</span></a></div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0"><img src="{{ asset('dashboard/assets') }}/images/user/avatar-1.jpg"
                                alt="user-image" class="user-avtar wid-45 rounded-circle"></div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0" style="font-size: 12px">{{ Auth::user()->name }}</h6><small>{{ Auth::user()->role }}</small>
                        </div><a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink"><svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg></a>
                    </div>

                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="#!" data-bs-toggle="modal" data-bs-target="#changePassword"><svg class="pc-icon text-muted me-2"> <use xlink:href="#custom-share-bold"></use> </svg> <span>Ganti Password</span></a>
                            <a href="#!"><i class="ti ti-settings"></i><span>Settings</span></a>
                            <a href="{{ route('logout') }}"><i class="ti ti-power"></i><span>Logout</span></a>
                        </div>

                    </div>

                </div>
            </div>

            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label>Navigation</label></li>
                <li class="pc-item"><a href="{{ route('dashboard.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/house.png" alt="NT"></span><span class="pc-mtext">Home</span></a></li>
                <li class="pc-item"><a href="{{ route('production.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/production.png" alt="NT"></span><span class="pc-mtext">Produksi Per Jam</span></a></li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/dashboard.png" alt="DS"> </span><span class="pc-mtext">Dashboard</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span> <span class="pc-badge">3</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('front-loading.index') }}">Front Loading</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('alat-support.index') }}">Alat Support</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('catatan-pengawas.index') }}">Catatan Pengawas</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-caption"><label>Laporan Harian</label> <svg class="pc-icon">
                        <use xlink:href="#custom-presentation-chart"></use>
                    </svg>
                </li>
                {{-- <li class="pc-item"><a href="#" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/excavator.png" alt="EX"></span><span class="pc-mtext">Front Loading</span></a></li> --}}
                <li class="pc-item"><a href="{{ route('form-pengawas.show') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/list.png" alt="BD"></span><span class="pc-mtext">Daftar Laporan</span></a></li>
                <li class="pc-item"><a href="{{ route('form-pengawas.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" alt="NT"></span><span class="pc-mtext">Form Pengawas</span></a></li>
                <li class="pc-item pc-caption"><label>KLKH</label> <svg class="pc-icon">
                        <use xlink:href="#custom-presentation-chart"></use>
                    </svg>
                </li>
                <li class="pc-item"><a href="{{ route('klkh.loading-point') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="NT"></span><span class="pc-mtext">Loading Point</span></a></li>
                <li class="pc-item"><a href="{{ route('klkh.haul-road') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="NT"></span><span class="pc-mtext">Haul Road</span></a></li>
                <li class="pc-item"><a href="{{ route('klkh.disposal') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="NT"></span><span class="pc-mtext">Disposal/Dumping Point</span></a></li>
            </ul>
        </div>
    </div>
</nav>
@include('layout.modal.change-password')
