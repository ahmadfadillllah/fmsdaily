@include('layout.head', ['title' => 'KLKH Haul Road'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Haul Road</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.haul-road.post') }}" method="POST">
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
                                <!-- 1. Lebar jalan angkut 3,5x unit terbesar -->
                                <div class="mb-3">
                                    <label for="road_width_check">1. Lebar jalan angkut 3,5x unit terbesar:</label>
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

                                <!-- 2. Lebar jalan tikungan 4x unit terbesar -->
                                <div class="mb-3">
                                    <label for="curve_width_check">2. Lebar jalan tikungan 4x unit terbesar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="curve_width_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="curve_width_true" name="curve_width_check" value="true" required /> Ya
                                        </label>
                                        <label for="curve_width_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="curve_width_false" name="curve_width_check" value="false" /> Tidak
                                        </label>
                                        <label for="curve_width_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="curve_width_na" name="curve_width_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="curve_width_note" id="curve_width_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 3. Super elevasi sesuai dengan standar -->
                                <div class="mb-3">
                                    <label for="super_elevation_check">3. Super elevasi sesuai dengan standar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="super_elevation_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="super_elevation_true" name="super_elevation_check" value="true" required /> Ya
                                        </label>
                                        <label for="super_elevation_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="super_elevation_false" name="super_elevation_check" value="false" /> Tidak
                                        </label>
                                        <label for="super_elevation_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="super_elevation_na" name="super_elevation_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="super_elevation_note" id="super_elevation_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 4. Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter -->
                                <div class="mb-3">
                                    <label for="safety_berm_check">4. Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter:</label>
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
                                <!-- 5. Tanggul jalan minimal 3/4 tinggi ban unit terbesar -->
                                <div class="mb-3">
                                    <label for="tanggul_check">5. Tanggul jalan minimal 3/4 tinggi ban unit terbesar:</label>
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
                                <!-- 6. Terdapat patok safety pada jarak 20 meter dengan tinggi 2 meter -->
                                <div class="mb-3">
                                    <label for="safety_patok_check">6. Terdapat patok safety pada jarak 20 meter dengan tinggi 2 meter:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="safety_patok_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_patok_true" name="safety_patok_check" value="true" required /> Ya
                                        </label>
                                        <label for="safety_patok_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_patok_false" name="safety_patok_check" value="false" /> Tidak
                                        </label>
                                        <label for="safety_patok_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="safety_patok_na" name="safety_patok_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="safety_patok_note" id="safety_patok_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 7. Tersedia drainage dan tidak ada genangan air di jalan angkut -->
                                <div class="mb-3">
                                    <label for="drainage_check">7. Tersedia drainage dan tidak ada genangan air di jalan angkut:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="drainage_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainage_true" name="drainage_check" value="true" required /> Ya
                                        </label>
                                        <label for="drainage_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainage_false" name="drainage_check" value="false" /> Tidak
                                        </label>
                                        <label for="drainage_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="drainage_na" name="drainage_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="drainage_note" id="drainage_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 8. Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60° -->
                                <div class="mb-3">
                                    <label for="median_check">8. Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60°:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="median_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="median_true" name="median_check" value="true" required /> Ya
                                        </label>
                                        <label for="median_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="median_false" name="median_check" value="false" /> Tidak
                                        </label>
                                        <label for="median_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="median_na" name="median_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="median_note" id="median_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 9. Intersection sesuai dengan standar -->
                                <div class="mb-3">
                                    <label for="intersection_check">9. Intersection sesuai dengan standar:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="intersection_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_true" name="intersection_check" value="true" required /> Ya
                                        </label>
                                        <label for="intersection_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_false" name="intersection_check" value="false" /> Tidak
                                        </label>
                                        <label for="intersection_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="intersection_na" name="intersection_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="intersection_note" id="intersection_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 10. Tersedia rambu-rambu lalu lintas jalan dan post guide lengkap -->
                                <div class="mb-3">
                                    <label for="traffic_sign_check">10. Tersedia rambu-rambu lalu lintas jalan dan post guide lengkap (ada lapisan pantul cahaya):</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="traffic_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="traffic_sign_true" name="traffic_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="traffic_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="traffic_sign_false" name="traffic_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="traffic_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="traffic_sign_na" name="traffic_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="traffic_sign_note" id="traffic_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 11. Tersedia rambu-rambu dan lampu (untuk pekerjaan malam hari) -->
                                <div class="mb-3">
                                    <label for="night_work_sign_check">11. Tersedia rambu-rambu dan lampu (untuk pekerjaan malam hari) di persimpangan jalan dan tidak ada blind spot:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="night_work_sign_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="night_work_sign_true" name="night_work_sign_check" value="true" required /> Ya
                                        </label>
                                        <label for="night_work_sign_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="night_work_sign_false" name="night_work_sign_check" value="false" /> Tidak
                                        </label>
                                        <label for="night_work_sign_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="night_work_sign_na" name="night_work_sign_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="night_work_sign_note" id="night_work_sign_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 12. Kondisi jalan cross fall dan tidak bergelombang -->
                                <div class="mb-3">
                                    <label for="road_condition_check">12. Kondisi jalan cross fall dan tidak bergelombang:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="road_condition_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="road_condition_true" name="road_condition_check" value="true" required /> Ya
                                        </label>
                                        <label for="road_condition_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="road_condition_false" name="road_condition_check" value="false" /> Tidak
                                        </label>
                                        <label for="road_condition_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="road_condition_na" name="road_condition_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="road_condition_note" id="road_condition_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 13. Adanya jalur pemisah atau marka jalan -->
                                <div class="mb-3">
                                    <label for="divider_check">13. Adanya jalur pemisah atau marka jalan, bila diperlukan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="divider_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="divider_true" name="divider_check" value="true" required /> Ya
                                        </label>
                                        <label for="divider_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="divider_false" name="divider_check" value="false" /> Tidak
                                        </label>
                                        <label for="divider_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="divider_na" name="divider_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="divider_note" id="divider_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 14. Jalur angkut rata, tidak bergelombang, dan bebas dari tumpahan material -->
                                <div class="mb-3">
                                    <label for="haul_route_check">14. Jalur angkut rata, tidak bergelombang, dan bebas dari tumpahan material dan spoil-spoil:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="haul_route_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="haul_route_true" name="haul_route_check" value="true" required /> Ya
                                        </label>
                                        <label for="haul_route_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="haul_route_false" name="haul_route_check" value="false" /> Tidak
                                        </label>
                                        <label for="haul_route_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="haul_route_na" name="haul_route_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="haul_route_note" id="haul_route_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 15. Terdapat penyiraman jalan sebagai pengendalian debu -->
                                <div class="mb-3">
                                    <label for="dust_control_check">15. Terdapat penyiraman jalan sebagai pengendalian debu pada jalan:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="dust_control_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="dust_control_true" name="dust_control_check" value="true" required /> Ya
                                        </label>
                                        <label for="dust_control_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="dust_control_false" name="dust_control_check" value="false" /> Tidak
                                        </label>
                                        <label for="dust_control_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dust_control_na" name="dust_control_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="dust_control_note" id="dust_control_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- 16. Tersedia petugas pengatur simpang-4 -->
                                <div class="mb-3">
                                    <label for="intersection_officer_check">16. Tersedia petugas pengatur simpang-4:</label>
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
                                <!-- 17. Lampu merah berfungsi baik -->
                                <div class="mb-3">
                                    <label for="red_light_check">17. Lampu merah berfungsi baik:</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="red_light_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="red_light_true" name="red_light_check" value="true" required /> Ya
                                        </label>
                                        <label for="red_light_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="red_light_false" name="red_light_check" value="false" /> Tidak
                                        </label>
                                        <label for="red_light_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="red_light_na" name="red_light_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="red_light_note" id="red_light_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
                                                                @foreach ($users['supervisor'] as $sv)
                                                                    <option value="{{ $sv->NRP }}">{{ $sv->PERSONALNAME }}</option>
                                                                @endforeach
                                                            </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="superintendent">Superintendent</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1"
                                                                name="superintendent">
                                                                <option selected disabled></option>
                                                                @foreach ($users['superintendent'] as $si)
                                                                    <option value="{{ $si->NRP }}">{{ $si->PERSONALNAME }}</option>
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
