@include('layout.head', ['title' => 'KLKH Loading Point'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Loading Point</h3>
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
                            <form action="{{ route('klkh.loading-point.post') }}" method="POST">
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

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label for="loading_point_check">1. Lokasi loading point tidak dibawah batuan
                                        menggantung:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="loading_point_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_true" name="loading_point_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="loading_point_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_false" name="loading_point_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="loading_point_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_na" name="loading_point_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="loading_point_note" id="loading_point_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 2 -->
                                <div class="mb-3">
                                    <label for="front_surface_check">2. Permukaan front aman dari bahaya terjatuh atau
                                        terperosok:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="front_surface_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="front_surface_true" name="front_surface_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="front_surface_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="front_surface_false" name="front_surface_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="front_surface_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="front_surface_na" name="front_surface_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="front_surface_note" id="front_surface_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 3 -->
                                <div class="mb-3">
                                    <label for="bench_work_check">3. Tinggi dan lebar bench kerja sesuai dengan standar
                                        parameter ( Buku Panduan Foreman/Supervisor Lapangan):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bench_work_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bench_work_true" name="bench_work_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="bench_work_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bench_work_false" name="bench_work_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="bench_work_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bench_work_na" name="bench_work_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bench_work_note" id="bench_work_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 4 -->
                                <div class="mb-3">
                                    <label for="access_dike_check">4. Tinggi tanggul akses jalan masuk loading point
                                        3/4 tinggi roda terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="access_dike_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="access_dike_true" name="access_dike_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="access_dike_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="access_dike_false" name="access_dike_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="access_dike_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="access_dike_na" name="access_dike_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="access_dike_note" id="access_dike_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 5 -->
                                <div class="mb-3">
                                    <label for="loading_point_width_check">5. Lebar loading point sesuai dengan standar
                                        pada spesifikasi unit loading:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="loading_point_width_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_width_true"
                                                name="loading_point_width_check" value="true" required /> Ya
                                        </label>
                                        <label for="loading_point_width_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_width_false"
                                                name="loading_point_width_check" value="false" /> Tidak
                                        </label>
                                        <label for="loading_point_width_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_point_width_na"
                                                name="loading_point_width_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="loading_point_width_note"
                                        id="loading_point_width_note" class="form-control form-control-sm pb-2 mt-2"
                                        placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 6 -->
                                <div class="mb-3">
                                    <label for="drainage_check">6. Terdapat drainage atau paritan kearah sump:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="drainage_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainage_true" name="drainage_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="drainage_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainage_false" name="drainage_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="drainage_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainage_na" name="drainage_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="drainage_note" id="drainage_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 7 -->
                                <div class="mb-3">
                                    <label for="no_waves_check">7. Loading point tidak bergelombang, tidak berair, dan
                                        bebas batuan lepas:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="no_waves_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="no_waves_true" name="no_waves_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="no_waves_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="no_waves_false" name="no_waves_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="no_waves_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="no_waves_na" name="no_waves_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="no_waves_note" id="no_waves_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 8 -->
                                <div class="mb-3">
                                    <label for="unit_placement_check">8. Penempatan unit loading sesuai dengan volume
                                        material pada area tersebut:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="unit_placement_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_placement_true"
                                                name="unit_placement_check" value="true" required /> Ya
                                        </label>
                                        <label for="unit_placement_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_placement_false"
                                                name="unit_placement_check" value="false" /> Tidak
                                        </label>
                                        <label for="unit_placement_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="unit_placement_na" name="unit_placement_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="unit_placement_note" id="unit_placement_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 9 -->
                                <div class="mb-3">
                                    <label for="material_stock_check">9. Stok material cukup:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="material_stock_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="material_stock_true"
                                                name="material_stock_check" value="true" required /> Ya
                                        </label>
                                        <label for="material_stock_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="material_stock_false"
                                                name="material_stock_check" value="false" /> Tidak
                                        </label>
                                        <label for="material_stock_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="material_stock_na" name="material_stock_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="material_stock_note" id="material_stock_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 10 -->
                                <div class="mb-3">
                                    <label for="loading_hauling_check">10. Kombinasi unit loading dan unit hauling
                                        sesuai:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="loading_hauling_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_hauling_true"
                                                name="loading_hauling_check" value="true" required /> Ya
                                        </label>
                                        <label for="loading_hauling_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_hauling_false"
                                                name="loading_hauling_check" value="false" /> Tidak
                                        </label>
                                        <label for="loading_hauling_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="loading_hauling_na"
                                                name="loading_hauling_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="loading_hauling_note" id="loading_hauling_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 11 -->
                                <div class="mb-3">
                                    <label for="dust_control_check">11. Pengendalian debu sudah dilakukan dengan baik
                                        (penyiraman terjadwal dan jumlahnya mencukupi):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dust_control_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dust_control_true" name="dust_control_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="dust_control_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dust_control_false" name="dust_control_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="dust_control_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dust_control_na" name="dust_control_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dust_control_note" id="dust_control_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 12 -->
                                <div class="mb-3">
                                    <label for="lighting_check">12. Penerangan areal kerja mencukupi dan terarah untuk
                                        pekerjaan malam hari:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lighting_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lighting_true" name="lighting_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="lighting_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lighting_false" name="lighting_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="lighting_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lighting_na" name="lighting_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lighting_note" id="lighting_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Pertanyaan 13 -->
                                <div class="mb-3">
                                    <label for="housekeeping_check">13. Kebersihan sekitar area pembuangan &
                                        Housekeeping baik (bebas sampah):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="housekeeping_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_true" name="housekeeping_check"
                                                value="true" required /> Ya
                                        </label>
                                        <label for="housekeeping_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_false" name="housekeeping_check"
                                                value="false" /> Tidak
                                        </label>
                                        <label for="housekeeping_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_na" name="housekeeping_check"
                                                value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="housekeeping_note" id="housekeeping_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
