@include('layout.head', ['title' => 'KLKH Dumping di Kolam Air/Lumpur'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Dumping di Kolam Air/Lumpur</h3>
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
                            <form action="{{ route('klkh.lumpur.post') }}" method="POST" id="submitFormKLKHLumpur">
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

                                <h4>A. JALAN</h4>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label for="unit_breakdown_check">1. Apakah terdapat unit breakdown di jalan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="unit_breakdown_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_breakdown_true" name="unit_breakdown_check" value="true" required /> Ya
                                        </label>
                                        <label for="unit_breakdown_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_breakdown_false" name="unit_breakdown_check" value="false" /> Tidak
                                        </label>
                                        <label for="unit_breakdown_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_breakdown_na" name="unit_breakdown_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="unit_breakdown_note" id="unit_breakdown_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_check">2. Terdapat rambu rambu jalan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_true" name="rambu_check" value="true" required /> Ya
                                        </label>
                                        <label for="rambu_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_false" name="rambu_check" value="false" /> Tidak
                                        </label>
                                        <label for="rambu_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_na" name="rambu_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="rambu_note" id="rambu_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="grade_check">3. Terdapat pelaporan grade jalan Max 12 %:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="grade_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="grade_true" name="grade_check" value="true" required /> Ya
                                        </label>
                                        <label for="grade_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="grade_false" name="grade_check" value="false" /> Tidak
                                        </label>
                                        <label for="grade_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="grade_na" name="grade_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="grade_note" id="grade_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="unit_maintenance_check">4. Terdapat Unit Maintenance Jalan (MG, BD, EXC):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="unit_maintenance_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_maintenance_true" name="unit_maintenance_check" value="true" required /> Ya
                                        </label>
                                        <label for="unit_maintenance_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_maintenance_false" name="unit_maintenance_check" value="false" /> Tidak
                                        </label>
                                        <label for="unit_maintenance_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_maintenance_na" name="unit_maintenance_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="unit_maintenance_note" id="unit_maintenance_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="debu_check">5. Terdapat unit pengendalian Debu (WT):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="debu_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="debu_true" name="debu_check" value="true" required /> Ya
                                        </label>
                                        <label for="debu_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="debu_false" name="debu_check" value="false" /> Tidak
                                        </label>
                                        <label for="debu_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="debu_na" name="debu_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="debu_note" id="debu_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lebar_jalan_check">6. Lebar jalan min 21 meter:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lebar_jalan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_true" name="lebar_jalan_check" value="true" required /> Ya
                                        </label>
                                        <label for="lebar_jalan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_false" name="lebar_jalan_check" value="false" /> Tidak
                                        </label>
                                        <label for="lebar_jalan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_na" name="lebar_jalan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lebar_jalan_note" id="lebar_jalan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="blind_spot_check">7. Terdapat area blind spot:</label>
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
                                    <label for="kondisi_jalan_check">8. Kondisi jalan bergelombang (andulating):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_jalan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kondisi_jalan_true" name="kondisi_jalan_check" value="true" required /> Ya
                                        </label>
                                        <label for="kondisi_jalan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kondisi_jalan_false" name="kondisi_jalan_check" value="false" /> Tidak
                                        </label>
                                        <label for="kondisi_jalan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kondisi_jalan_na" name="kondisi_jalan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kondisi_jalan_note" id="kondisi_jalan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tanggul_jalan_check">9. Terdapat Tanggul jalan dengan tinggi 3/4 dari diameter tyre HD terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tanggul_jalan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggul_jalan_true" name="tanggul_jalan_check" value="true" required /> Ya
                                        </label>
                                        <label for="tanggul_jalan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggul_jalan_false" name="tanggul_jalan_check" value="false" /> Tidak
                                        </label>
                                        <label for="tanggul_jalan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggul_jalan_na" name="tanggul_jalan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="tanggul_jalan_note" id="tanggul_jalan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pengelolaan_air_check">10. Terdapat pengelolaan air di jalan saat Hujan (sodetan, drainase):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pengelolaan_air_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengelolaan_air_true" name="pengelolaan_air_check" value="true" required /> Ya
                                        </label>
                                        <label for="pengelolaan_air_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengelolaan_air_false" name="pengelolaan_air_check" value="false" /> Tidak
                                        </label>
                                        <label for="pengelolaan_air_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengelolaan_air_na" name="pengelolaan_air_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pengelolaan_air_note" id="pengelolaan_air_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h4>B. DUMPINGAN</h4>
                                <hr>
                                <div class="mb-3">
                                    <label for="crack_check">11. Apakah terdapat crack, patahan penurunan dumpingan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="crack_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="crack_true" name="crack_check" value="true" required /> Ya
                                        </label>
                                        <label for="crack_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="crack_false" name="crack_check" value="false" /> Tidak
                                        </label>
                                        <label for="crack_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="crack_na" name="crack_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="crack_note" id="crack_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="luas_area_check">12. Apakah luas area dumpingan mencukupi untuk manuver HD (min 30 meter):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="luas_area_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="luas_area_true" name="luas_area_check" value="true" required /> Ya
                                        </label>
                                        <label for="luas_area_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="luas_area_false" name="luas_area_check" value="false" /> Tidak
                                        </label>
                                        <label for="luas_area_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="luas_area_na" name="luas_area_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="luas_area_note" id="luas_area_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tanggul_check">13. Apakah terdapat tanggul dumpingan (bundwall) dengan tinggi 3/4 dari diameter tyre HD terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tanggul_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggul_true" name="tanggul_check" value="true" required /> Ya
                                        </label>
                                        <label for="tanggul_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggul_false" name="tanggul_check" value="false" /> Tidak
                                        </label>
                                        <label for="tanggul_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggul_na" name="tanggul_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="tanggul_note" id="tanggul_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="free_dump_check">14. Apakah terdapat free dump di area dumpingan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="free_dump_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="free_dump_true" name="free_dump_check" value="true" required /> Ya
                                        </label>
                                        <label for="free_dump_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="free_dump_false" name="free_dump_check" value="false" /> Tidak
                                        </label>
                                        <label for="free_dump_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="free_dump_na" name="free_dump_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="free_dump_note" id="free_dump_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="alokasi_material_check">15. Apakah terdapat pengelolaan alokasi material kurang bagus:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="alokasi_material_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="alokasi_material_true" name="alokasi_material_check" value="true" required /> Ya
                                        </label>
                                        <label for="alokasi_material_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="alokasi_material_false" name="alokasi_material_check" value="false" /> Tidak
                                        </label>
                                        <label for="alokasi_material_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="alokasi_material_na" name="alokasi_material_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="alokasi_material_note" id="alokasi_material_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="beda_level_check">16. Apakah terdapat beda level area dumpingan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="beda_level_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="beda_level_true" name="beda_level_check" value="true" required /> Ya
                                        </label>
                                        <label for="beda_level_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="beda_level_false" name="beda_level_check" value="false" /> Tidak
                                        </label>
                                        <label for="beda_level_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="beda_level_na" name="beda_level_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="beda_level_note" id="beda_level_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tinggi_dumpingan_check">17. Apakah tinggi dumpingan max 2.5 meter dari permukaan air/lumpur:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tinggi_dumpingan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_dumpingan_true" name="tinggi_dumpingan_check" value="true" required /> Ya
                                        </label>
                                        <label for="tinggi_dumpingan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_dumpingan_false" name="tinggi_dumpingan_check" value="false" /> Tidak
                                        </label>
                                        <label for="tinggi_dumpingan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_dumpingan_na" name="tinggi_dumpingan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="tinggi_dumpingan_note" id="tinggi_dumpingan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="genangan_air_check">18. Apakah terdapat genangan air di area dumpingan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="genangan_air_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="genangan_air_true" name="genangan_air_check" value="true" required /> Ya
                                        </label>
                                        <label for="genangan_air_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="genangan_air_false" name="genangan_air_check" value="false" /> Tidak
                                        </label>
                                        <label for="genangan_air_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="genangan_air_na" name="genangan_air_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="genangan_air_note" id="genangan_air_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="dumpingan_bergelombang_check">19. Apakah dumpingan bergelombang:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumpingan_bergelombang_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumpingan_bergelombang_true" name="dumpingan_bergelombang_check" value="true" required /> Ya
                                        </label>
                                        <label for="dumpingan_bergelombang_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumpingan_bergelombang_false" name="dumpingan_bergelombang_check" value="false" /> Tidak
                                        </label>
                                        <label for="dumpingan_bergelombang_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumpingan_bergelombang_na" name="dumpingan_bergelombang_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumpingan_bergelombang_note" id="dumpingan_bergelombang_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bendera_acuan_check">20. Apakah terdapat bendera acuan dumpingan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bendera_acuan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bendera_acuan_true" name="bendera_acuan_check" value="true" required /> Ya
                                        </label>
                                        <label for="bendera_acuan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bendera_acuan_false" name="bendera_acuan_check" value="false" /> Tidak
                                        </label>
                                        <label for="bendera_acuan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bendera_acuan_na" name="bendera_acuan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bendera_acuan_note" id="bendera_acuan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_jarak_check">21. Apakah terdapat rambu jarak dumping 7,5 m:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_jarak_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_jarak_true" name="rambu_jarak_check" value="true" required /> Ya
                                        </label>
                                        <label for="rambu_jarak_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_jarak_false" name="rambu_jarak_check" value="false" /> Tidak
                                        </label>
                                        <label for="rambu_jarak_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_jarak_na" name="rambu_jarak_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="rambu_jarak_note" id="rambu_jarak_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tower_lamp_check">22. Apakah terdapat tower lamp (Penerangan cukup saat gelap/malam hari):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tower_lamp_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="tower_lamp_true" name="tower_lamp_check" value="true" required /> Ya
                                        </label>
                                        <label for="tower_lamp_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="tower_lamp_false" name="tower_lamp_check" value="false" /> Tidak
                                        </label>
                                        <label for="tower_lamp_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tower_lamp_na" name="tower_lamp_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="tower_lamp_note" id="tower_lamp_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="penyalur_petir_check">23. Apakah terdapat penyalur petir (penangkal petir):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="penyalur_petir_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="penyalur_petir_true" name="penyalur_petir_check" value="true" required /> Ya
                                        </label>
                                        <label for="penyalur_petir_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="penyalur_petir_false" name="penyalur_petir_check" value="false" /> Tidak
                                        </label>
                                        <label for="penyalur_petir_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="penyalur_petir_na" name="penyalur_petir_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="penyalur_petir_note" id="penyalur_petir_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="muster_point_check">24. Apakah terdapat area tempat berkumpul saat terjadi emergency (Muster Point):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="muster_point_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="muster_point_true" name="muster_point_check" value="true" required /> Ya
                                        </label>
                                        <label for="muster_point_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="muster_point_false" name="muster_point_check" value="false" /> Tidak
                                        </label>
                                        <label for="muster_point_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="muster_point_na" name="muster_point_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="muster_point_note" id="muster_point_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="safety_bundwall_check">25. Apakah terdapat area parkir sarana dengan safety bund wall:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="safety_bundwall_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_bundwall_true" name="safety_bundwall_check" value="true" required /> Ya
                                        </label>
                                        <label for="safety_bundwall_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_bundwall_false" name="safety_bundwall_check" value="false" /> Tidak
                                        </label>
                                        <label for="safety_bundwall_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_bundwall_na" name="safety_bundwall_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="safety_bundwall_note" id="safety_bundwall_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="ring_buoy_check">26. Apakah terdapat Ring buoy dengan tali panjang 15 m:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ring_buoy_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="ring_buoy_true" name="ring_buoy_check" value="true" required /> Ya
                                        </label>
                                        <label for="ring_buoy_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="ring_buoy_false" name="ring_buoy_check" value="false" /> Tidak
                                        </label>
                                        <label for="ring_buoy_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="ring_buoy_na" name="ring_buoy_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="ring_buoy_note" id="ring_buoy_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sling_ware_check">27. Apakah terdapat sling ware:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sling_ware_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="sling_ware_true" name="sling_ware_check" value="true" required /> Ya
                                        </label>
                                        <label for="sling_ware_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="sling_ware_false" name="sling_ware_check" value="false" /> Tidak
                                        </label>
                                        <label for="sling_ware_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sling_ware_na" name="sling_ware_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="sling_ware_note" id="sling_ware_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pondok_pengawas_check">28. Apakah terdapat pondok pengawas:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pondok_pengawas_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pondok_pengawas_true" name="pondok_pengawas_check" value="true" required /> Ya
                                        </label>
                                        <label for="pondok_pengawas_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pondok_pengawas_false" name="pondok_pengawas_check" value="false" /> Tidak
                                        </label>
                                        <label for="pondok_pengawas_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pondok_pengawas_na" name="pondok_pengawas_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pondok_pengawas_note" id="pondok_pengawas_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="struktur_pengawas_check">29. Apakah terdapat struktur pengawas:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="struktur_pengawas_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="struktur_pengawas_true" name="struktur_pengawas_check" value="true" required /> Ya
                                        </label>
                                        <label for="struktur_pengawas_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="struktur_pengawas_false" name="struktur_pengawas_check" value="false" /> Tidak
                                        </label>
                                        <label for="struktur_pengawas_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="struktur_pengawas_na" name="struktur_pengawas_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="struktur_pengawas_note" id="struktur_pengawas_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="life_jacket_bulldozer_check">30. Apakah terdapat Life Jacket untuk Unit Bulldozer:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="life_jacket_bulldozer_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="life_jacket_bulldozer_true" name="life_jacket_bulldozer_check" value="true" required /> Ya
                                        </label>
                                        <label for="life_jacket_bulldozer_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="life_jacket_bulldozer_false" name="life_jacket_bulldozer_check" value="false" /> Tidak
                                        </label>
                                        <label for="life_jacket_bulldozer_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="life_jacket_bulldozer_na" name="life_jacket_bulldozer_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="life_jacket_bulldozer_note" id="life_jacket_bulldozer_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="emergency_number_check">31. Apakah terdapat nomor Emergency di area disposal:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="emergency_number_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_number_true" name="emergency_number_check" value="true" required /> Ya
                                        </label>
                                        <label for="emergency_number_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_number_false" name="emergency_number_check" value="false" /> Tidak
                                        </label>
                                        <label for="emergency_number_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_number_na" name="emergency_number_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="emergency_number_note" id="emergency_number_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="life_jacket_spotter_check">32. Apakah terdapat Life Jacket untuk Spotter:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="life_jacket_spotter_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="life_jacket_spotter_true" name="life_jacket_spotter_check" value="true" required /> Ya
                                        </label>
                                        <label for="life_jacket_spotter_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="life_jacket_spotter_false" name="life_jacket_spotter_check" value="false" /> Tidak
                                        </label>
                                        <label for="life_jacket_spotter_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="life_jacket_spotter_na" name="life_jacket_spotter_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="life_jacket_spotter_note" id="life_jacket_spotter_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonKLKHLumpur">Submit</button>
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

    const formKLKHLumpur = document.getElementById('submitFormKLKHLumpur');
    const submitButtonKLKHLumpur = document.getElementById('submitButtonKLKHLumpur');

    formKLKHLumpur.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonKLKHLumpur.disabled = true;
        submitButtonKLKHLumpur.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHLumpur.disabled = false;
            submitButtonKLKHLumpur.innerText = 'Submit';
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
