@include('layout.head', ['title' => 'KLKH Batu Bara'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Batu Bara</h3>
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
                            <form action="{{ route('klkh.batubara.post') }}" method="POST">
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
                                <h4>A. Coal Loading Point</h4>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label for="loading_point_check">1. Lokasi loading point tidak dibawah batuan menggantung:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="loading_point_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_true" name="loading_point_check" value="true" required /> Ya
                                        </label>
                                        <label for="loading_point_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_false" name="loading_point_check" value="false" /> Tidak
                                        </label>
                                        <label for="loading_point_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_na" name="loading_point_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="loading_point_note" id="loading_point_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="permukaan_front_check">2. Permukaan front aman dari bahaya terjatuh atau terperosok:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="permukaan_front_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="permukaan_front_true" name="permukaan_front_check" value="true" required /> Ya
                                        </label>
                                        <label for="permukaan_front_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="permukaan_front_false" name="permukaan_front_check" value="false" /> Tidak
                                        </label>
                                        <label for="permukaan_front_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="permukaan_front_na" name="permukaan_front_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="permukaan_front_note" id="permukaan_front_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tinggi_bench_check">3. Tinggi dan lebar bench kerja sesuai dengan standar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tinggi_bench_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_bench_true" name="tinggi_bench_check" value="true" required /> Ya
                                        </label>
                                        <label for="tinggi_bench_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_bench_false" name="tinggi_bench_check" value="false" /> Tidak
                                        </label>
                                        <label for="tinggi_bench_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_bench_na" name="tinggi_bench_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="tinggi_bench_note" id="tinggi_bench_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lebar_loading_check">4. Lebar loading point sesuai dengan standar pada spesifikasi unit loading:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lebar_loading_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_loading_true" name="lebar_loading_check" value="true" required /> Ya
                                        </label>
                                        <label for="lebar_loading_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_loading_false" name="lebar_loading_check" value="false" /> Tidak
                                        </label>
                                        <label for="lebar_loading_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_loading_na" name="lebar_loading_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lebar_loading_note" id="lebar_loading_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="drainase_check">5. Terdapat drainase atau paritan ke arah sump:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="drainase_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainase_true" name="drainase_check" value="true" required /> Ya
                                        </label>
                                        <label for="drainase_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainase_false" name="drainase_check" value="false" /> Tidak
                                        </label>
                                        <label for="drainase_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainase_na" name="drainase_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="drainase_note" id="drainase_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="penempatan_unit_check">6. Penempatan unit loading sesuai dengan volume Batubara:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="penempatan_unit_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="penempatan_unit_true" name="penempatan_unit_check" value="true" required /> Ya
                                        </label>
                                        <label for="penempatan_unit_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="penempatan_unit_false" name="penempatan_unit_check" value="false" /> Tidak
                                        </label>
                                        <label for="penempatan_unit_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="penempatan_unit_na" name="penempatan_unit_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="penempatan_unit_note" id="penempatan_unit_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pelabelan_seam_check">7. Terdapat pelabelan seam batubara di unit (hauler dan loader):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pelabelan_seam_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pelabelan_seam_true" name="pelabelan_seam_check" value="true" required /> Ya
                                        </label>
                                        <label for="pelabelan_seam_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pelabelan_seam_false" name="pelabelan_seam_check" value="false" /> Tidak
                                        </label>
                                        <label for="pelabelan_seam_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pelabelan_seam_na" name="pelabelan_seam_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pelabelan_seam_note" id="pelabelan_seam_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lampu_unit_check">8. Unit yang bekerja memiliki lampu dengan intensitas cahaya yang tinggi:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lampu_unit_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lampu_unit_true" name="lampu_unit_check" value="true" required /> Ya
                                        </label>
                                        <label for="lampu_unit_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lampu_unit_false" name="lampu_unit_check" value="false" /> Tidak
                                        </label>
                                        <label for="lampu_unit_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lampu_unit_na" name="lampu_unit_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lampu_unit_note" id="lampu_unit_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="unit_bersih_check">9. Unit yang bekerja bersih dan sudah dicuci:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="unit_bersih_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_bersih_true" name="unit_bersih_check" value="true" required /> Ya
                                        </label>
                                        <label for="unit_bersih_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_bersih_false" name="unit_bersih_check" value="false" /> Tidak
                                        </label>
                                        <label for="unit_bersih_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_bersih_na" name="unit_bersih_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="unit_bersih_note" id="unit_bersih_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="penerangan_area_check">10. Penerangan area kerja mencukupi dan terarah untuk pekerjaan malam hari (20-50 lux):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="penerangan_area_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="penerangan_area_true" name="penerangan_area_check" value="true" required /> Ya
                                        </label>
                                        <label for="penerangan_area_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="penerangan_area_false" name="penerangan_area_check" value="false" /> Tidak
                                        </label>
                                        <label for="penerangan_area_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="penerangan_area_na" name="penerangan_area_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="penerangan_area_note" id="penerangan_area_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="housekeeping_check">11. Housekeeping baik (bebas sampah):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="housekeeping_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_true" name="housekeeping_check" value="true" required /> Ya
                                        </label>
                                        <label for="housekeeping_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_false" name="housekeeping_check" value="false" /> Tidak
                                        </label>
                                        <label for="housekeeping_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_na" name="housekeeping_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="housekeeping_note" id="housekeeping_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pengukuran_roof_check">12. Telah dilakukan pengukuran roof Batubara oleh survey:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pengukuran_roof_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengukuran_roof_true" name="pengukuran_roof_check" value="true" required /> Ya
                                        </label>
                                        <label for="pengukuran_roof_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengukuran_roof_false" name="pengukuran_roof_check" value="false" /> Tidak
                                        </label>
                                        <label for="pengukuran_roof_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengukuran_roof_na" name="pengukuran_roof_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pengukuran_roof_note" id="pengukuran_roof_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="cleaning_batubara_check">13. Telah dilakukan cleaning pada Batubara dan Batubara bebas kontaminan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="cleaning_batubara_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="cleaning_batubara_true" name="cleaning_batubara_check" value="true" required /> Ya
                                        </label>
                                        <label for="cleaning_batubara_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="cleaning_batubara_false" name="cleaning_batubara_check" value="false" /> Tidak
                                        </label>
                                        <label for="cleaning_batubara_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="cleaning_batubara_na" name="cleaning_batubara_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="cleaning_batubara_note" id="cleaning_batubara_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="genangan_air_check">14. Tidak terdapat genangan air pada Batubara:</label>
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
                                    <label for="big_coal_check">15. Tidak terdapat big coal:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="big_coal_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="big_coal_true" name="big_coal_check" value="true" required /> Ya
                                        </label>
                                        <label for="big_coal_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="big_coal_false" name="big_coal_check" value="false" /> Tidak
                                        </label>
                                        <label for="big_coal_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="big_coal_na" name="big_coal_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="big_coal_note" id="big_coal_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="stock_material_check">16. Stock material cukup:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="stock_material_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="stock_material_true" name="stock_material_check" value="true" required /> Ya
                                        </label>
                                        <label for="stock_material_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="stock_material_false" name="stock_material_check" value="false" /> Tidak
                                        </label>
                                        <label for="stock_material_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="stock_material_na" name="stock_material_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="stock_material_note" id="stock_material_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <h4>B. Jalan Tambang</h4>
                                <hr>
                                <div class="mb-3">
                                    <label for="lebar_jalan_angkut_check">17. Lebar jalan angkut 3.5 x lebar unit terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lebar_jalan_angkut_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_angkut_true" name="lebar_jalan_angkut_check" value="true" required /> Ya
                                        </label>
                                        <label for="lebar_jalan_angkut_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_angkut_false" name="lebar_jalan_angkut_check" value="false" /> Tidak
                                        </label>
                                        <label for="lebar_jalan_angkut_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_angkut_na" name="lebar_jalan_angkut_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lebar_jalan_angkut_note" id="lebar_jalan_angkut_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lebar_jalan_tikungan_check">18. Lebar jalan tikungan 4 x lebar unit terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lebar_jalan_tikungan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_tikungan_true" name="lebar_jalan_tikungan_check" value="true" required /> Ya
                                        </label>
                                        <label for="lebar_jalan_tikungan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_tikungan_false" name="lebar_jalan_tikungan_check" value="false" /> Tidak
                                        </label>
                                        <label for="lebar_jalan_tikungan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lebar_jalan_tikungan_na" name="lebar_jalan_tikungan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lebar_jalan_tikungan_note" id="lebar_jalan_tikungan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="super_elevasi_check">19. Super elevasi sesuai standar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="super_elevasi_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="super_elevasi_true" name="super_elevasi_check" value="true" required /> Ya
                                        </label>
                                        <label for="super_elevasi_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="super_elevasi_false" name="super_elevasi_check" value="false" /> Tidak
                                        </label>
                                        <label for="super_elevasi_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="super_elevasi_na" name="super_elevasi_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="super_elevasi_note" id="super_elevasi_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="safety_berm_check">20. Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="safety_berm_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_berm_true" name="safety_berm_check" value="true" required /> Ya
                                        </label>
                                        <label for="safety_berm_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_berm_false" name="safety_berm_check" value="false" /> Tidak
                                        </label>
                                        <label for="safety_berm_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_berm_na" name="safety_berm_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="safety_berm_note" id="safety_berm_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tinggi_tanggul_check">21. Tinggi tanggul minimal 2/3 tinggi ban unit terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tinggi_tanggul_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_tanggul_true" name="tinggi_tanggul_check" value="true" required /> Ya
                                        </label>
                                        <label for="tinggi_tanggul_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_tanggul_false" name="tinggi_tanggul_check" value="false" /> Tidak
                                        </label>
                                        <label for="tinggi_tanggul_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tinggi_tanggul_na" name="tinggi_tanggul_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="tinggi_tanggul_note" id="tinggi_tanggul_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="safety_post_check">22. Terdapat safety post pada tanggul jalan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="safety_post_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_post_true" name="safety_post_check" value="true" required /> Ya
                                        </label>
                                        <label for="safety_post_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_post_false" name="safety_post_check" value="false" /> Tidak
                                        </label>
                                        <label for="safety_post_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_post_na" name="safety_post_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="safety_post_note" id="safety_post_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="drainase_genangan_air_check">23. Tersedia drainase dan tidak ada genangan air di jalan angkut:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="drainase_genangan_air_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainase_genangan_air_true" name="drainase_genangan_air_check" value="true" required /> Ya
                                        </label>
                                        <label for="drainase_genangan_air_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainase_genangan_air_false" name="drainase_genangan_air_check" value="false" /> Tidak
                                        </label>
                                        <label for="drainase_genangan_air_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainase_genangan_air_na" name="drainase_genangan_air_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="drainase_genangan_air_note" id="drainase_genangan_air_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="median_jalan_check">24. Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60°:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="median_jalan_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="median_jalan_true" name="median_jalan_check" value="true" required /> Ya
                                        </label>
                                        <label for="median_jalan_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="median_jalan_false" name="median_jalan_check" value="false" /> Tidak
                                        </label>
                                        <label for="median_jalan_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="median_jalan_na" name="median_jalan_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="median_jalan_note" id="median_jalan_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
