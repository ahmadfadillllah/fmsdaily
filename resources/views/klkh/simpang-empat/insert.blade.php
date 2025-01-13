@include('layout.head', ['title' => 'KLKH Intersection (Simpang Empat)'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Intersection (Simpang Empat)</h3>
                    </div>
                    {{-- <div class="col-12">
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
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.simpangempat.post') }}" method="POST" id="submitFormKLKHSimpangEmpat">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <!-- Kolom 1: PIT dan Shift -->
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="pit">PIT</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2"
                                                                name="pit" required>
                                                                <option selected disabled></option>
                                                                @foreach ($users['pit'] as $pit)
                                                                    <option value="{{ $pit->id }}">{{ $pit->keterangan }}</option>
                                                                @endforeach
                                                            </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="shift">Shift</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1"
                                                                name="shift" required>
                                                                <option selected disabled></option>
                                                                @foreach ($users['shift'] as $sh)
                                                                    <option value="{{ $sh->id }}">{{ $sh->keterangan }}</option>
                                                                @endforeach
                                                            </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Kolom 2: Hari/Tanggal dan Jam -->
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari/ Tanggal</label>
                                        <input type="date" class="form-control form-control-sm pb-2" id="date" name="date" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" class="form-control form-control-sm pb-2" id="time" name="time" required>
                                    </div>
                                </div>
                                <hr>
                                <h4>A. Rambu</h4>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label for="intersection_name_check">1. Papan informasi nama intersection:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="intersection_name_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_name_true" name="intersection_name_check" value="true" required /> Ya
                                        </label>
                                        <label for="intersection_name_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_name_false" name="intersection_name_check" value="false" /> Tidak
                                        </label>
                                        <label for="intersection_name_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_name_na" name="intersection_name_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="intersection_name_note" id="intersection_name_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="speed_limit_sign_check">2. Rambu batas kecepatan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="speed_limit_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="speed_limit_sign_true" name="speed_limit_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="speed_limit_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="speed_limit_sign_false" name="speed_limit_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="speed_limit_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="speed_limit_sign_na" name="speed_limit_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="speed_limit_sign_note" id="speed_limit_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="intersection_sign_check">3. Rambu simpang 4:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="intersection_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_sign_true" name="intersection_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="intersection_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_sign_false" name="intersection_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="intersection_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_sign_na" name="intersection_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="intersection_sign_note" id="intersection_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="caution_sign_check">4. Rambu hati-hati:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="caution_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="caution_sign_true" name="caution_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="caution_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="caution_sign_false" name="caution_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="caution_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="caution_sign_na" name="caution_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="caution_sign_note" id="caution_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="stop_sign_check">5. Rambu batas berhenti:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="stop_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="stop_sign_true" name="stop_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="stop_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="stop_sign_false" name="stop_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="stop_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="stop_sign_na" name="stop_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="stop_sign_note" id="stop_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="horn_sign_unit_check">6. Rambu mulai & berhenti klakson:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="horn_sign_unit_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="horn_sign_unit_true" name="horn_sign_unit_check" value="true" required /> Ya
                                        </label>
                                        <label for="horn_sign_unit_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="horn_sign_unit_false" name="horn_sign_unit_check" value="false" /> Tidak
                                        </label>
                                        <label for="horn_sign_unit_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="horn_sign_unit_na" name="horn_sign_unit_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="horn_sign_unit_note" id="horn_sign_unit_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="double_sign_check">7. Rambu Ganda (stop dan penunjuk arah):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="double_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="double_sign_true" name="double_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="double_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="double_sign_false" name="double_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="double_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="double_sign_na" name="double_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="double_sign_note" id="double_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="right_turn_prohibited_check">8. Rambu larangan belok kanan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="right_turn_prohibited_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="right_turn_prohibited_true" name="right_turn_prohibited_check" value="true" required /> Ya
                                        </label>
                                        <label for="right_turn_prohibited_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="right_turn_prohibited_false" name="right_turn_prohibited_check" value="false" /> Tidak
                                        </label>
                                        <label for="right_turn_prohibited_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="right_turn_prohibited_na" name="right_turn_prohibited_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="right_turn_prohibited_note" id="right_turn_prohibited_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h4>B. Lokasi Kerja</h4>
                                <hr>
                                <div class="mb-3">
                                    <label for="traffic_light_check">9. Lampu Trafic berfungsi dengan baik:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="traffic_light_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="traffic_light_true" name="traffic_light_check" value="true" required /> Ya
                                        </label>
                                        <label for="traffic_light_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="traffic_light_false" name="traffic_light_check" value="false" /> Tidak
                                        </label>
                                        <label for="traffic_light_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="traffic_light_na" name="traffic_light_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="traffic_light_note" id="traffic_light_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="intersection_officer_check">10. Terdapat petugas Intersection yang memiliki kartu petugas intersection:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="intersection_officer_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_officer_true" name="intersection_officer_check" value="true" required /> Ya
                                        </label>
                                        <label for="intersection_officer_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_officer_false" name="intersection_officer_check" value="false" /> Tidak
                                        </label>
                                        <label for="intersection_officer_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_officer_na" name="intersection_officer_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="intersection_officer_note" id="intersection_officer_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="radio_communication_check">11. Terdapat radio komunikasi dengan channel yang sesuai:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="radio_communication_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="radio_communication_true" name="radio_communication_check" value="true" required /> Ya
                                        </label>
                                        <label for="radio_communication_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="radio_communication_false" name="radio_communication_check" value="false" /> Tidak
                                        </label>
                                        <label for="radio_communication_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="radio_communication_na" name="radio_communication_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="radio_communication_note" id="radio_communication_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="intersection_monitoring_check">12. Posisi pondok intersection memungkinkan petugas Intersection memantau lalulintas dengan baik di area intersection:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="intersection_monitoring_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_monitoring_true" name="intersection_monitoring_check" value="true" required /> Ya
                                        </label>
                                        <label for="intersection_monitoring_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_monitoring_false" name="intersection_monitoring_check" value="false" /> Tidak
                                        </label>
                                        <label for="intersection_monitoring_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_monitoring_na" name="intersection_monitoring_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="intersection_monitoring_note" id="intersection_monitoring_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="standard_road_medium_check">13. Terdapat median jalan standar dengan rambu ganda:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="standard_road_medium_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="standard_road_medium_true" name="standard_road_medium_check" value="true" required /> Ya
                                        </label>
                                        <label for="standard_road_medium_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="standard_road_medium_false" name="standard_road_medium_check" value="false" /> Tidak
                                        </label>
                                        <label for="standard_road_medium_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="standard_road_medium_na" name="standard_road_medium_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="standard_road_medium_note" id="standard_road_medium_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="road_width_check">14. Lebar jalan 3,5 x unit terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="road_width_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="road_width_true" name="road_width_check" value="true" required /> Ya
                                        </label>
                                        <label for="road_width_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="road_width_false" name="road_width_check" value="false" /> Tidak
                                        </label>
                                        <label for="road_width_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="road_width_na" name="road_width_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="road_width_note" id="road_width_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="smooth_transport_path_check">15. Jalur angkut rata, tidak bergelombang, dan bebas dari tumpahan material dan spoil:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="smooth_transport_path_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="smooth_transport_path_true" name="smooth_transport_path_check" value="true" required /> Ya
                                        </label>
                                        <label for="smooth_transport_path_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="smooth_transport_path_false" name="smooth_transport_path_check" value="false" /> Tidak
                                        </label>
                                        <label for="smooth_transport_path_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="smooth_transport_path_na" name="smooth_transport_path_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="smooth_transport_path_note" id="smooth_transport_path_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="blind_spot_check">16. Tidak terdapat blind spot:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="blind_spot_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="blind_spot_true" name="blind_spot_check" value="true" required /> Ya
                                        </label>
                                        <label for="blind_spot_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="blind_spot_false" name="blind_spot_check" value="false" /> Tidak
                                        </label>
                                        <label for="blind_spot_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="blind_spot_na" name="blind_spot_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="blind_spot_note" id="blind_spot_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="radius_check">17. Pada radius 75 m sebelum intersection, tinggi bund wall / tanggul jalan wall adalah 75 cm:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="radius_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="radius_true" name="radius_check" value="true" required /> Ya
                                        </label>
                                        <label for="radius_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="radius_false" name="radius_check" value="false" /> Tidak
                                        </label>
                                        <label for="radius_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="radius_na" name="radius_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="radius_note" id="radius_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="trash_bin_check">18. Terdapat tempat sampah:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="trash_bin_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="trash_bin_true" name="trash_bin_check" value="true" required /> Ya
                                        </label>
                                        <label for="trash_bin_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="trash_bin_false" name="trash_bin_check" value="false" /> Tidak
                                        </label>
                                        <label for="trash_bin_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="trash_bin_na" name="trash_bin_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="trash_bin_note" id="trash_bin_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="toilet_facility_check">19. Terdapat fasilitas toilet:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="toilet_facility_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="toilet_facility_true" name="toilet_facility_check" value="true" required /> Ya
                                        </label>
                                        <label for="toilet_facility_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="toilet_facility_false" name="toilet_facility_check" value="false" /> Tidak
                                        </label>
                                        <label for="toilet_facility_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="toilet_facility_na" name="toilet_facility_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="toilet_facility_note" id="toilet_facility_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="lighting_check">20. Tingkat pencahayaan minimal 20 Lux:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lighting_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lighting_true" name="lighting_check" value="true" required /> Ya
                                        </label>
                                        <label for="lighting_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lighting_false" name="lighting_check" value="false" /> Tidak
                                        </label>
                                        <label for="lighting_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lighting_na" name="lighting_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lighting_note" id="lighting_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="first_aid_box_check">21. Terdapat Kotak P3K:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="first_aid_box_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="first_aid_box_true" name="first_aid_box_check" value="true" required /> Ya
                                        </label>
                                        <label for="first_aid_box_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="first_aid_box_false" name="first_aid_box_check" value="false" /> Tidak
                                        </label>
                                        <label for="first_aid_box_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="first_aid_box_na" name="first_aid_box_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="first_aid_box_note" id="first_aid_box_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="fire_extinguisher_check">22. Terdapat APAR (Alat Pemadam Api Ringan):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="fire_extinguisher_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="fire_extinguisher_true" name="fire_extinguisher_check" value="true" required /> Ya
                                        </label>
                                        <label for="fire_extinguisher_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="fire_extinguisher_false" name="fire_extinguisher_check" value="false" /> Tidak
                                        </label>
                                        <label for="fire_extinguisher_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fire_extinguisher_na" name="fire_extinguisher_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="fire_extinguisher_note" id="fire_extinguisher_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="parking_area_check">23. Terdapat Parkir area sarana beserta rambu parkir:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="parking_area_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="parking_area_true" name="parking_area_check" value="true" required /> Ya
                                        </label>
                                        <label for="parking_area_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="parking_area_false" name="parking_area_check" value="false" /> Tidak
                                        </label>
                                        <label for="parking_area_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="parking_area_na" name="parking_area_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="parking_area_note" id="parking_area_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="lightning_rod_check">24. Terdapat Penyalur Petir:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lightning_rod_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lightning_rod_true" name="lightning_rod_check" value="true" required /> Ya
                                        </label>
                                        <label for="lightning_rod_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lightning_rod_false" name="lightning_rod_check" value="false" /> Tidak
                                        </label>
                                        <label for="lightning_rod_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lightning_rod_na" name="lightning_rod_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lightning_rod_note" id="lightning_rod_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <div class="mb-3">
                                    <label for="sop_check">25. Terdapat SOP intersection dalam pondok:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sop_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="sop_true" name="sop_check" value="true" required /> Ya
                                        </label>
                                        <label for="sop_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="sop_false" name="sop_check" value="false" /> Tidak
                                        </label>
                                        <label for="sop_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sop_na" name="sop_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="sop_note" id="sop_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>

                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <!-- Kolom 1: PIT dan Shift -->
                                    @if (Auth::user()->role != 'SUPERVISOR')
                                        <div class="col-md-6 col-12 px-2 py-2">
                                            <label for="supervisor">Supervisor</label>
                                            <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2"
                                                                    name="supervisor">
                                                                    <option selected disabled></option>
                                                                    @foreach ($users['supervisor'] as $sv)
                                                                        <option value="{{ $sv->NRP }}">{{ $sv->PERSONALNAME }}</option>
                                                                    @endforeach
                                                                </select>
                                        </div>
                                    @endif
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="superintendent">Superintendent</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1"
                                                                name="superintendent">
                                                                <option selected disabled></option>
                                                                @foreach ($users['superintendent'] as $si)
                                                                    <option value="{{ $si->NRP }}">{{ $si->PERSONALNAME }} ({{ $si->JABATAN }})</option>
                                                                @endforeach
                                                            </select>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonKLKHSimpangEmpat">Submit</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')

<script>

    const formKLKHSimpangEmpat = document.getElementById('submitFormKLKHSimpangEmpat');
    const submitButtonKLKHSimpangEmpat = document.getElementById('submitButtonKLKHSimpangEmpat');

    formKLKHSimpangEmpat.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonKLKHSimpangEmpat.disabled = true;
        submitButtonKLKHSimpangEmpat.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHSimpangEmpat.disabled = false;
            submitButtonKLKHSimpangEmpat.innerText = 'Submit';
        }, 7000);
    });
</script>

<script>
    window.onload = function() {
        var currentDate = new Date();

        // Format tanggal Indonesia (DD-MM-YYYY)
        var dd = ("0" + currentDate.getDate()).slice(-2); // Menambahkan 0 jika tanggal < 10
        var mm = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Menambahkan 0 jika bulan < 10
        var yyyy = currentDate.getFullYear();
        var formattedDate = yyyy + "-" + mm + "-" + dd; // Tanggal untuk input type="date" (YYYY-MM-DD)

        // Format waktu (HH:MM)
        var hours = ("0" + currentDate.getHours()).slice(-2); // Menambahkan 0 jika jam < 10
        var minutes = ("0" + currentDate.getMinutes()).slice(-2); // Menambahkan 0 jika menit < 10
        var formattedTime = hours + ":" + minutes;

        // Isi input dengan tanggal dan waktu saat ini
        document.getElementById("date").value = formattedDate;
        document.getElementById("time").value = formattedTime;
    }
    document.querySelector("form").addEventListener("submit", function(e) {
        const radioGroups = Array.from(new Set([...document.querySelectorAll("input[type='radio']")].map(r => r
            .name)));
        const incompleteGroups = radioGroups.filter(groupName => {
            return !document.querySelector(`input[name="${groupName}"]:checked`);
        });

        if (incompleteGroups.length > 0) {
            e.preventDefault();
            alert("Silakan isi semua pilihan True/False/N/A sebelum mengirimkan form!");
        }
    });
</script>
