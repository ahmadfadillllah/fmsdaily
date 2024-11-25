@include('layout.head', ['title' => 'KLKH Disposal/Dumping Point'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Disposal/Dumping Point</h3>
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
                            <form action="{{ route('klkh.disposal.post') }}" method="POST">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <!-- Kolom 1: PIT dan Shift -->
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="pit">PIT</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2"
                                                                name="pit" required>
                                                                <option selected disabled></option>
                                                                <option value="SM-B1">SM-B1</option>
                                                                <option value="SM-B2">SM-B2</option>
                                                                <option value="SM-A3">SM-A3</option>
                                                                <option value="SM-6">SM-6</option>
                                                                <option value="All Area">All Area</option>
                                                            </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="shift">Shift</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1"
                                                                name="shift" required>
                                                                <option selected disabled></option>
                                                                <option value="Siang">Siang</option>
                                                                <option value="Malam">Malam</option>
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

                                <!-- Form dengan radio button -->
                                <!-- Pertanyaan 1 -->
                                <div class="mb-3">
                                    <label for="dumping_point_1">1. Lebar dumping point 2x (lebar unit terbesar + turn radius) x N Load:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_1_true" name="dumping_point_1" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_1_false" name="dumping_point_1" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_1_na" name="dumping_point_1" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_1_note" id="dumping_point_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 2 -->
                                <div class="mb-3">
                                    <label for="dumping_point_2">2. Adanya patok cek elevasi:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_2_true" name="dumping_point_2" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_2_false" name="dumping_point_2" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_2_na" name="dumping_point_2" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_2_note" id="dumping_point_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 3 -->
                                <div class="mb-3">
                                    <label for="dumping_point_3">3. Tinggi tanggul dumpingan atau dump/bud wall 3/4 tinggi ban unit terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_3_true" name="dumping_point_3" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_3_false" name="dumping_point_3" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_3_na" name="dumping_point_3" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_3_note" id="dumping_point_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 4 -->
                                <div class="mb-3">
                                    <label for="dumping_point_4">4. Kondisi permukaan lantai dumping rata dan permukaan tanah tidak lembek dan tidak bergelombang:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_4_true" name="dumping_point_4" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_4_false" name="dumping_point_4" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_4_na" name="dumping_point_4" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_4_note" id="dumping_point_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 5 -->
                                <div class="mb-3">
                                    <label for="dumping_point_5">5. Tidak ada genangan air di lokasi dumping:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_5_true" name="dumping_point_5" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_5_false" name="dumping_point_5" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_5_na" name="dumping_point_5" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_5_note" id="dumping_point_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 6 -->
                                <div class="mb-3">
                                    <label for="dumping_point_6">6. Terdapat unit support bulldozer di lokasi dumping:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_6_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_6_true" name="dumping_point_6" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_6_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_6_false" name="dumping_point_6" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_6_na" name="dumping_point_6" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_6_note" id="dumping_point_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 7 -->
                                <div class="mb-3">
                                    <label for="dumping_point_7">7. Rambu atau papan informasi memadai:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_7_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_7_true" name="dumping_point_7" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_7_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_7_false" name="dumping_point_7" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_7_na" name="dumping_point_7" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_7_note" id="dumping_point_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 8 -->
                                <div class="mb-3">
                                    <label for="dumping_point_8">8. Tersedia lampu penerangan untuk pekerjaan malam hari:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_8_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_8_true" name="dumping_point_8" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_8_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_8_false" name="dumping_point_8" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_8_na" name="dumping_point_8" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_8_note" id="dumping_point_8_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 9 -->
                                <div class="mb-3">
                                    <label for="dumping_point_9">9. Pengendalian debu sudah dilakukan dengan baik (penyiraman terjadwal dan jumlahnya mencukupi):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_9_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_9_true" name="dumping_point_9" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_9_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_9_false" name="dumping_point_9" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_9_na" name="dumping_point_9" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_9_note" id="dumping_point_9_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 10 -->
                                <div class="mb-3">
                                    <label for="dumping_point_10">10. Frame final disposal rapi dan sesuai desain (dimensi slope sesuai dengan standar):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_10_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_10_true" name="dumping_point_10" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_10_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_10_false" name="dumping_point_10" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_10_na" name="dumping_point_10" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_10_note" id="dumping_point_10_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 11 -->
                                <div class="mb-3">
                                    <label for="dumping_point_11">11. Terdapat pondok dump man:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_11_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_11_true" name="dumping_point_11" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_11_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_11_false" name="dumping_point_11" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_11_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_11_na" name="dumping_point_11" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_11_note" id="dumping_point_11_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 12 -->
                                <div class="mb-3">
                                    <label for="dumping_point_12">12. Terdapat bendera merah dan hijau untuk penunjuk dumping dan informasi lokasi bahaya untuk dumping:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_12_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_12_true" name="dumping_point_12" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_12_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_12_false" name="dumping_point_12" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_12_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_12_na" name="dumping_point_12" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_12_note" id="dumping_point_12_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 13 -->
                                <div class="mb-3">
                                    <label for="dumping_point_13">13. Housekeeping terjaga (disposal rapi dari tumpukan material yang belum di-spreading):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_13_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_13_true" name="dumping_point_13" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_13_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_13_false" name="dumping_point_13" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_13_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_13_na" name="dumping_point_13" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_13_note" id="dumping_point_13_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 14 -->
                                <div class="mb-3">
                                    <label for="dumping_point_14">14. Alokasi material di disposal sesuai dengan rencana:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_14_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_14_true" name="dumping_point_14" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_14_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_14_false" name="dumping_point_14" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_14_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_14_na" name="dumping_point_14" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_14_note" id="dumping_point_14_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 15 -->
                                <div class="mb-3">
                                    <label for="dumping_point_15">15. Operator melakukan metode dumping sesuai dengan prosedur:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_15_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_15_true" name="dumping_point_15" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_15_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_15_false" name="dumping_point_15" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_15_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_15_na" name="dumping_point_15" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_15_note" id="dumping_point_15_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 16 -->
                                <div class="mb-3">
                                    <label for="dumping_point_16">16. Terdapat petugas pemandu HD untuk mundur (Stopper/Pengawas):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_16_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_16_true" name="dumping_point_16" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_16_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_16_false" name="dumping_point_16" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_16_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_16_na" name="dumping_point_16" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_16_note" id="dumping_point_16_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 17 -->
                                <div class="mb-3">
                                    <label for="dumping_point_17">17. Petugas memiliki radio komunikasi (HT):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_17_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_17_true" name="dumping_point_17" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_17_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_17_false" name="dumping_point_17" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_17_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_17_na" name="dumping_point_17" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_17_note" id="dumping_point_17_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 18 -->
                                <div class="mb-3">
                                    <label for="dumping_point_18">18. Terdapat median pemisah ruas jalan akses masuk & keluar area pembuangan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_18_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_18_true" name="dumping_point_18" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_18_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_18_false" name="dumping_point_18" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_18_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_18_na" name="dumping_point_18" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_18_note" id="dumping_point_18_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 19 -->
                                <div class="mb-3">
                                    <label for="dumping_point_19">19. Tersedia tanggul (pipa Gorong-gorong) untuk dumping lumpur cair:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_19_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_19_true" name="dumping_point_19" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_19_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_19_false" name="dumping_point_19" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_19_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_19_na" name="dumping_point_19" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_19_note" id="dumping_point_19_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 20 -->
                                <div class="mb-3">
                                    <label for="dumping_point_20">20. Kondisi pasak penahan gorong-gorong kuat tidak goyah:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_20_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_20_true" name="dumping_point_20" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_20_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_20_false" name="dumping_point_20" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_20_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_20_na" name="dumping_point_20" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_20_note" id="dumping_point_20_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 21 -->
                                <div class="mb-3">
                                    <label for="dumping_point_21">21. Kondisi apron masih baik tidak tergerus lumpur cair:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_21_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_21_true" name="dumping_point_21" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_21_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_21_false" name="dumping_point_21" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_21_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_21_na" name="dumping_point_21" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_21_note" id="dumping_point_21_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 22 -->
                                <div class="mb-3">
                                    <label for="dumping_point_22">22. Material Top Soil di tempatkan khusus dan tidak tercampur material OB:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dumping_point_22_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_22_true" name="dumping_point_22" value="true" required /> Ya
                                        </label>
                                        <label for="dumping_point_22_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_22_false" name="dumping_point_22" value="false" /> Tidak
                                        </label>
                                        <label for="dumping_point_22_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_point_22_na" name="dumping_point_22" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dumping_point_22_note" id="dumping_point_22_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="supervisor">Supervisor</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2"
                                                                name="supervisor">
                                                                <option selected disabled></option>
                                                                @foreach ($users as $item)
                                                                    <option value="{{ $item->NRP }}">{{ $item->PERSONALNAME }}</option>
                                                                @endforeach
                                                            </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="superintendent">Superintendent</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1"
                                                                name="superintendent">
                                                                <option selected disabled></option>
                                                                @foreach ($users as $item)
                                                                    <option value="{{ $item->NRP }}">{{ $item->PERSONALNAME }}</option>
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
