<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header"><a href="#" class="b-brand text-primary">
                <img src="{{ asset('dashboard/assets') }}/images/icon.png" class="img-fluid" width="100px" alt="logo">
                <span class="badge bg-light-success rounded-pill ms-2 theme-version">Daily Pengawas</span></a></div>
        <div class="navbar-content">
            <a style="color:#001932;" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"><img src="{{ asset('dashboard/assets') }}/images/user/avatar-1.png"
                                    alt="user-image" class="user-avtar wid-45 rounded-circle"></div>
                            <div class="flex-grow-1 ms-3 me-2">
                                <h6 class="mb-0" style="font-size: 12px">{{ Auth::user()->name }}</h6><small>{{ Auth::user()->role }}</small>
                            </div><svg class="pc-icon">
                                    <use xlink:href="#custom-sort-outline"></use>
                                </svg>
                        </div>

                        <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                            <div class="pt-3">
                                <a href="#!" data-bs-toggle="modal" data-bs-target="#changePassword"><svg class="pc-icon text-muted me-2"> <use xlink:href="#custom-share-bold"></use> </svg> <span>Ganti Password</span></a>
                                <a href="#!"><i class="ti ti-settings"></i><span>Profil</span></a>
                                <a href="{{ route('logout') }}"><i class="ti ti-power"></i><span>Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label>Navigation</label></li>
                <li class="pc-item"><a href="{{ route('dashboard.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/house.png" alt="NT"></span><span class="pc-mtext">Home</span></a></li>
                <li class="pc-item"><a href="{{ route('production.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/production.png" alt="NT"></span><span class="pc-mtext">Produksi Per Jam</span></a></li>
                <li class="pc-item"><a href="{{ route('payloadritation.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/loading.png" alt="NT"></span><span class="pc-mtext">Payload & Ritation</span></a></li>
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
                @if(Auth::user()->role != 'ADMIN')
                    <li class="pc-item"><a href="{{ route('form-pengawas-old.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" alt="NT"></span><span class="pc-mtext">Form Pengawas</span></a></li>
                @endif

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="DS"> </span><span class="pc-mtext">KLKH</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span> <span class="pc-badge">7</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.loading-point') }}">Loading Point</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.haul-road') }}">Haul Road</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.disposal') }}">Disposal/Dumping Point</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.lumpur') }}">Dumping di Kolam Air/Lumpur</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.ogs') }}">OGS</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.batubara') }}">Batu Bara</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('klkh.simpangempat') }}">Intersection (Simpang Empat)</a></li>
                    </ul>
                </li>
                @if (Auth::user()->role != 'FOREMAN')
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon">
                            <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/stamp.png" alt="DS"> </span><span class="pc-mtext">Verifikasi</span> <span class="pc-arrow"><i
                                    data-feather="chevron-right"></i></span> <span class="pc-badge">2</span>
                        </a>
                        <ul class="pc-submenu">
                            {{-- <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.laporankerja') }}">Laporan Kerja</a></li> --}}
                            <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh') }}">KLKH</a></li>
                            {{-- <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh.haulroad') }}">Haul Road</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh.disposal') }}">Disposal/Dumping Point</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh.lumpur') }}">Dumping di Kolam Air/Lumpur</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh.ogs') }}">OGS</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh.batubara') }}">Batu Bara</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh.simpangempat') }}">Intersection (Simpang Empat)</a></li> --}}
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->role == 'ADMIN')
                    <li class="pc-item pc-caption"><label>Configuration</label> <svg class="pc-icon">
                        <use xlink:href="#custom-presentation-chart"></use>
                        </svg>
                    </li>
                    <li class="pc-item"><a href="{{ route('user.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/user.png" alt="NT"></span><span class="pc-mtext">Users</span></a></li>
                    {{-- <li class="pc-item"><a href="{{ route('log.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/log.png" alt="NT"></span><span class="pc-mtext">Logging User</span></a></li> --}}
                    <li class="pc-item pc-caption"><label></label>
                        <svg class="pc-icon">
                            <use xlink:href="#custom-presentation-chart"></use>
                        </svg>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@include('layout.modal.change-password')
