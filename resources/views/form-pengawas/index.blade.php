@include('layout.head', ['title' => 'Catatan Pengawas'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .center-checkbox {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Forms</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Laporan Harian</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="basicwizard" class="form-wizard row justify-content-center">
                <div class="col-sm-12 col-md-6 col-xxl-4 text-center">
                    <h3>Laporan Harian Foreman</h3>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item" data-target-form="#contactDetailForm"><a href="#contactDetail"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link active"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/application.png"
                                            alt="EX"> <span class="d-none d-sm-inline">Log
                                            On</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#frontLoadingForm"><a href="#frontLoading"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link icon"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/excavator-2.png"
                                            alt="EX"> <span class="d-none d-sm-inline">Front
                                            Loading</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#alatSupportForm"><a href="#alatSupport"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/bulldozer.png"
                                            alt="EX">
                                        <span class="d-none d-sm-inline">Alat Support</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#catatanPengawasForm"><a href="#catatanPengawas"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/online-survey.png"
                                            alt="EX">
                                        <span class="d-none d-sm-inline">Catatan Pengawas</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item"><a href="#finish" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link icon-btn"><img class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/stamp.png"
                                            alt="EX">
                                        <span class="d-none d-sm-inline">Finish</span></a></li>
                                <!-- end nav item -->
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('form-pengawas.post') }}" method="post"  onsubmit="return validateForm()">
                                @csrf
                                <div class="tab-content">
                                    <!-- START: Define your progress bar here -->
                                    <div id="bar" class="progress mb-3" style="height: 7px">
                                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
                                        </div>
                                    </div><!-- END: Define your progress bar here -->
                                    <!-- START: Define your tab pans here -->
                                    <div class="tab-pane show active" id="contactDetail">
                                        <form id="contactForm" method="get"
                                            action="https://ableproadmin.com/forms/form2_wizard.html">
                                            <div class="text-center">
                                                <h3 class="mb-2">Informasi Dasar</h3>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3"><label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control"
                                                                    id="pc-datepicker-1" name="tanggal_dasar" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3"> <label class="form-label" for="exampleFormControlSelect1">Shift</label>
                                                                <select class="form-select" id="exampleFormControlSelect1" name="shift_dasar" >
                                                                    <option selected disabled></option>
                                                                    <option value="Siang">Siang</option>
                                                                    <option value="Malam">Malam</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3"> <label class="form-label"
                                                                    for="exampleFormControlSelect2">Area</label>
                                                                <select class="form-select" id="exampleFormControlSelect2"
                                                                    name="area" >
                                                                    <option selected disabled></option>
                                                                    <option value="SM-B1">SM-B1</option>
                                                                    <option value="SM-B2">SM-B2</option>
                                                                    <option value="SM-A3">SM-A3</option>
                                                                    <option value="SM-6">SM-6</option>
                                                                    <option value="All Area">All Area</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3"> <label class="form-label"
                                                                    for="exampleFormControlSelect3">Lokasi</label>
                                                                <select class="form-select" id="exampleFormControlSelect3"
                                                                    name="lokasi" >
                                                                    <option selected disabled></option>
                                                                    <option value="Loading Point">Loading Point</option>
                                                                    <option value="Disposal">Disposal</option>
                                                                    <option value="Pit Stop">Pit Stop</option>
                                                                    <option value="All Location">All Location</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <!-- Input NIK Supervisor -->
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="nikSupervisor">Supervisor</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nikSupervisor" name="nik_supervisor"
                                                                                placeholder="Masukkan NIK" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="additionalForm">Nama
                                                                                Supervisor</label>
                                                                            <input type="text" class="form-control"
                                                                                id="additionalForm" name="additionalForm"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-primary"
                                                                            id="btnCariSupervisor">Cari</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="row">
                                                                    <!-- Input NIK Superintendent -->
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="nikSupervisor">Superintendent</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nikSuperintendent"
                                                                                name="nik_superintendent"
                                                                                placeholder="Masukkan NIK" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="additionalForm">Nama
                                                                                Superintendent</label>
                                                                            <input type="text" class="form-control"
                                                                                id="additionalForm" name="additionalForm"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-primary"
                                                                            id="btnCariSuperintendent">Cari</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- end contact detail tab pane -->
                                    <div class="tab-pane" id="frontLoading">
                                        <div class="text-center">
                                            <h3 class="mb-2">Front Loading</h3>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="container mt-2">
                                                <button type="button" id="addColumnBtn" class="btn btn-primary mb-3">Tambah Kolom</button>
                                                <button type="button" id="removeColumnBtn" class="btn btn-danger mb-3">Hapus Kolom</button>
                                                <table id="dynamicTable" class="table table-bordered">
                                                    <thead style="text-align: center; vertical-align: middle;">
                                                        <tr id="headerRow1">
                                                            <th colspan="2">Jam</th>
                                                            <th class="unitHeader" scope="col">Nomor Unit 1</th>
                                                        </tr>
                                                        <tr id="headerRow2">
                                                            <th>Siang</th>
                                                            <th>Malam</th>
                                                            <th>
                                                                <select name="front_unit_number_1" class="form-control"
                                                                    >
                                                                    <option></option>
                                                                    @foreach ($data['EX'] as $exa)
                                                                        <option value="{{ $exa->VHC_ID }}">
                                                                            {{ $exa->VHC_ID }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="07.00 - 08.00">07.00 - 08.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="19.00 - 20.00">19.00 - 20.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="08.00 - 09.00">08.00 - 09.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="20.00 - 21.00">20.00 - 21.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="09.00 - 10.00">09.00 - 10.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="21.00 - 22.00">21.00 - 22.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="10.00 - 11.00">10.00 - 11.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="22.00 - 23.00">22.00 - 23.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="11.00 - 12.00">11.00 - 12.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="23.00 - 24.00">23.00 - 24.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="12.00 - 13.00">12.00 - 13.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="24.00 - 01.00">24.00 - 01.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="13.00 - 14.00">13.00 - 14.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="01.00 - 02.00">01.00 - 02.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="14.00 - 15.00">14.00 - 15.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="02.00 - 03.00">02.00 - 03.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="15.00 - 16.00">15.00 - 16.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="03.00 - 04.00">03.00 - 04.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="16.00 - 17.00">16.00 - 17.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="04.00 - 05.00">04.00 - 05.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="17.00 - 18.00">17.00 - 18.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="05.00 - 06.00">05.00 - 06.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="hidden" name="front_time_siang[]"
                                                                    value="18.00 - 19.00">18.00 - 19.00</td>
                                                            <td><input type="hidden" name="front_time_malam[]"
                                                                    value="06.00 - 07.00">06.00 - 07.00</td>
                                                            <td><input type="checkbox" name="front_checkbox_1[]"
                                                                    class="form-check-input" ></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- end job detail tab pane -->
                                    <div class="tab-pane" id="alatSupport">
                                            <div class="text-center">
                                                <h3 class="mb-2">Alat Support</h3>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="container mt-2">
                                                    <button class="btn btn-primary mb-3" type="button" id="addRowButton">Tambah Baris</button>
                                                    <table id="dynamicTableSupport" class="table table-bordered">
                                                        <thead style="text-align: center; vertical-align: middle;">
                                                            <tr id="headerRowSupport1">
                                                                <th rowspan="2" scope="col">Jenis</th>
                                                                <th rowspan="2" scope="col">Nomor Unit</th>
                                                                <th colspan="4" scope="col">Operator</th>
                                                                <th colspan="4" scope="col">HM</th>
                                                                <th rowspan="2" scope="col">Material</th>
                                                                <th rowspan="2" scope="col">Aksi</th>
                                                            </tr>
                                                            <tr id="headerRowSupport2">
                                                                <th>NIK</th>
                                                                <th>Nama</th>
                                                                <th>Tanggal</th>
                                                                <th>Shift</th>
                                                                <th>Awal</th>
                                                                <th>Akhir</th>
                                                                <th>Total</th>
                                                                <th>Cash</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="newTableBodySupport">
                                                            <tr>
                                                                <td>
                                                                    <select class="form-select" name="jenis_support_1[]" >
                                                                        <option selected disabled></option>
                                                                        <option value="BD">BD</option>
                                                                        <option value="MG">MG</option>
                                                                        <option value="EX">EX</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select" name="unit_support_1[]" >
                                                                        <option selected disabled></option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="Support_1[]" class="form-control" ></td>
                                                                <td><input type="text" name="Support_1[]" class="form-control" disabled ></td>
                                                                <td><input type="text" class="form-control" id="pc-datepicker-2" name="tanggal" ></td>
                                                                <td>
                                                                    <select class="form-select" name="shift_support_1[]" >
                                                                        <option selected disabled></option>
                                                                        <option value="Siang">Siang</option>
                                                                        <option value="Malam">Malam</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="hm_awal_support_1[]" class="form-control" oninput="calculateTotalHM(this)" ></td>
                                                                <td><input type="text" name="hm_akhir_support_1[]" class="form-control" oninput="calculateTotalHM(this)" ></td>
                                                                <td><input type="text" name="hm_total_support_1[]" class="form-control" disabled ></td>
                                                                <td><input type="text" name="hm_cash_support_1[]" class="form-control" ></td>
                                                                <td>
                                                                    <select name="material_support_1" class="form-control"
                                                                    >
                                                                    <option></option>
                                                                    @foreach ($data['material'] as $mat)
                                                                        <option value="{{ $mat->MAT_ID }}"> {{ $mat->MAT_DESC }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger mb-3 btnRemoveSupport" type="button" onclick="removeRowSupport(this)">Hapus Baris</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="tab-pane" id="catatanPengawas">
                                            <div class="text-center">
                                                <h3 class="mb-2">Catatan Pengawas</h3>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="container mt-2">
                                                    <button id="btnAddRowNote" class="btn btn-primary mb-3">Tambah Baris</button>
                                                    <table id="dynamicTableNote" class="table table-bordered">
                                                        <thead style="text-align: center; vertical-align: middle;">
                                                            <tr id="headerRowNote1">
                                                                <th colspan="2">Jam</th>
                                                                <th rowspan="2" scope="col">Keterangan</th>
                                                                <th rowspan="2" scope="col">Aksi</th>
                                                            </tr>
                                                            <tr id="headerRowNote2">
                                                                <th>Start</th>
                                                                <th>Stop</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="newTableBodyNote">
                                                            <tr>
                                                                <td><input class="form-control start_time_input" name="start_time_note_1[]" type="text" placeholder="Pilih waktu"></td>
                                                                <td><input class="form-control end_time_input" name="end_time_note_1[]" type="text" placeholder="Pilih waktu"></td>
                                                                <td><input type="text" name="note_1[]" class="form-control" ></td>
                                                                <td>
                                                                    <button class="btn btn-danger mb-3 btnRemoveNote" type="button">Hapus Baris</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div><!-- end education detail tab pane -->
                                    <div class="tab-pane" id="finish">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="text-center"><i
                                                        class="ph-duotone ph-note f-50 text-danger"></i>
                                                    <h3 class="mt-4 mb-3">Terimakasih!</h3>
                                                    <p>Pastikan semua data pada form telah diisi dengan benar sebelum
                                                        melanjutkan ke tahap akhir.</p>
                                                    <div class="mb-3">
                                                        <div class="form-check d-inline-block"><input type="checkbox"
                                                                class="form-check-input" id="customCheck1"> <label
                                                                class="form-check-label" for="customCheck1">Saya sudah
                                                                mengisi form ini dengan benar</label></div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success ">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="d-flex wizard justify-content-between flex-wrap gap-2 mt-5">


                                        <div class="d-flex">


                                            <div class="previous me-2">
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm">Kembali</a>
                                            </div>
                                            <div class="next me-3">
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm">Lanjut</a>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="first me-3">
                                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm">Lembar Pertama</a>
                                            </div>
                                            <div class="last">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm">Finish</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('layout.footer')

{{-- Script Form Front Loading --}}
<script>
    const addColumnBtn = document.getElementById('addColumnBtn');
const removeColumnBtn = document.getElementById('removeColumnBtn');
const headerRow1 = document.getElementById('headerRow1');
const headerRow2 = document.getElementById('headerRow2');
const tableBody = document.getElementById('tableBody');

let unitCount = 1;

const exa = @json($data['EX']);

addColumnBtn.addEventListener('click', () => {
    unitCount++;

    // Tambah header kolom untuk Nomor Unit
    const newHeader1 = document.createElement('th');
    newHeader1.classList.add('unitHeader');
    newHeader1.textContent = `Nomor Unit ${unitCount}`;
    headerRow1.appendChild(newHeader1);

    // Tambah header kolom untuk dropdown
    const newHeader2 = document.createElement('th');
    const selectElement = document.createElement('select');
    selectElement.name = `front_unit_number_${unitCount}`;
    selectElement.classList.add('form-control');

    // Tambahkan option kosong
    const emptyOption = document.createElement('option');
    emptyOption.value = '';
    emptyOption.textContent = '';
    selectElement.appendChild(emptyOption);

    // Loop untuk menambahkan option berdasarkan data EXA
    exa.forEach(option => {
        if (option.VHC_ID) {
            const optionElement = document.createElement('option');
            optionElement.value = option.VHC_ID;
            optionElement.textContent = option.VHC_ID;
            selectElement.appendChild(optionElement);
        }
    });

    newHeader2.appendChild(selectElement);
    headerRow2.appendChild(newHeader2);

    // Loop untuk menambah kolom checkbox pada setiap row
    for (const row of tableBody.rows) {
        const newCell = document.createElement('td');
        newCell.innerHTML = `<input type="checkbox" name="front_checkbox_${unitCount}[]" class="form-check-input">`;
        row.appendChild(newCell);
    }
});

removeColumnBtn.addEventListener('click', () => {
    if (unitCount > 1) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus Nomor Unit ${unitCount}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hapus header dan kolom
                headerRow1.lastElementChild.remove();
                headerRow2.lastElementChild.remove();
                for (const row of tableBody.rows) {
                    row.lastElementChild.remove();
                }
                unitCount--;
                Swal.fire('Dihapus!', `Nomor Unit ${unitCount + 1} telah dihapus.`, 'success');
            }
        });
    } else {
        Swal.fire('Tidak Bisa Dihapus', 'Kolom Nomor Unit 1 tidak boleh dihapus.', 'error');
    }
});

function validateCheckboxes() {
    let isChecked = false;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach((row) => {
        const checkboxesInRow = row.querySelectorAll('input[type="checkbox"]');
        checkboxesInRow.forEach((checkbox) => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });
    });

    return isChecked;
}

</script>

{{-- Script Form Catatan Pengawas --}}
<script>
    const addRowButtonNew = document.getElementById('btnAddRowNote');
    const tableBodyNew = document.getElementById('newTableBodyNote');

    let rowCount = 1;

    function initializeFlatpickr() {
        document.querySelectorAll('.start_time_input').forEach((element) => {
            if (!element._flatpickr) {
                flatpickr(element, {
                    enableTime: true,
                    noCalendar: true,
                    time_24hr: true
                });
            }
        });

        document.querySelectorAll('.end_time_input').forEach((element) => {
            if (!element._flatpickr) {
                flatpickr(element, {
                    enableTime: true,
                    noCalendar: true,
                    time_24hr: true
                });
            }
        });
    }
    addRowButtonNew.addEventListener('click', (e) => {
        e.preventDefault();
        rowCount++;

        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input class="form-control start_time_input" name="start_time_note_${rowCount}[]" type="text" placeholder="Pilih waktu"></td>
            <td><input class="form-control end_time_input" name="end_time_note_${rowCount}[]" type="text" placeholder="Pilih waktu"></td>
            <td><input type="text" name="note_${rowCount}[]" class="form-control" ></td>
            <td>
                <button class="btn btn-danger mb-3 btnRemoveNote" type="button">Hapus Baris</button>
            </td>
        `;

        tableBodyNew.appendChild(newRow);
        activateRemoveButtons();
        initializeFlatpickr();
    });

    function activateRemoveButtons() {
        const removeRowButtons = document.querySelectorAll('.btnRemoveNote');

        removeRowButtons.forEach((button, index) => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                if (index === 0) {
                    Swal.fire('Tidak Bisa Dihapus', 'Baris pertama tidak boleh dihapus.', 'error');
                    return;
                }
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Baris ini akan dihapus.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const row = button.closest('tr');
                        row.remove();
                        Swal.fire('Dihapus!', 'Baris telah dihapus.', 'success');
                    }
                });
            });
        });
    }
    activateRemoveButtons();
    initializeFlatpickr();
</script>

{{-- Script Form Alat Support --}}
<script>
    const data = @json($data);

    function calculateTotalHM(element) {
        const row = element.closest('tr');
        const hmAwal = row.querySelector('[name^="hm_awal_support_1"]').value.replace(',', '.');
        const hmAkhir = row.querySelector('[name^="hm_akhir_support_1"]').value.replace(',', '.');

        if (hmAwal && hmAkhir) {
            const total = parseFloat(hmAkhir) - parseFloat(hmAwal);
            row.querySelector('[name^="hm_total_support_1"]').value = total.toFixed(1);
        } else {
            row.querySelector('[name^="hm_total_support_1"]').value = '';
        }
    }

    function updateUnitOptions(selectedType, unitSelect) {
        unitSelect.innerHTML = '<option selected disabled>Pilih unit</option>';
        if (data[selectedType]) {
            data[selectedType].forEach(item => {
                const option = document.createElement('option');
                option.value = item.VHC_ID;
                option.textContent = item.VHC_ID;
                unitSelect.appendChild(option);
            });
        }
    }

    document.getElementById('addRowButton').addEventListener('click', function() {
        const tableBody = document.getElementById('newTableBodySupport');
        const newRow = tableBody.querySelector('tr').cloneNode(true);
        newRow.querySelectorAll('input, select').forEach(input => {
            input.value = '';
        });

        newRow.querySelectorAll('[name^="jenis_support_1[]"]').forEach((input, index) => {
            input.setAttribute('name', 'jenis_support_' + (tableBody.children.length + 1));
        });
        newRow.querySelectorAll('[name^="unit_support_1[]"]').forEach((input, index) => {
            input.setAttribute('name', 'unit_support_' + (tableBody.children.length + 1));
        });

        // Add the cloned row to the table
        tableBody.appendChild(newRow);

        // Update event listener for unit selection in new row
        const newJenisSupport = newRow.querySelector('[name^="jenis_support_1[]"]');
        const newUnitSupport = newRow.querySelector('[name^="unit_support_1[]"]');
        newJenisSupport.addEventListener('change', function() {
            updateUnitOptions(this.value, newUnitSupport);
        });
    });

    function removeRowSupport(button) {
        const row = button.closest('tr');

        const rowIndex = Array.from(row.parentNode.children).indexOf(row);

        // Jika baris pertama, tidak mengizinkan penghapusan
        if (rowIndex === 0) {
            Swal.fire(
                'Tidak Bisa Dihapus!',
                'Baris pertama tidak bisa dihapus.',
                'error'
            );
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Baris ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                row.remove();
                Swal.fire(
                    'Dihapus!',
                    'Baris telah dihapus.',
                    'success'
                );
            } else {
                Swal.fire(
                    'Dibatalkan',
                    'Baris tidak jadi dihapus.',
                    'info'
                );
            }
        });
    }


</script>

<script>
    function validateForm() {
      var checkBox = document.getElementById("customCheck1");
      if (!checkBox.checked) {
        Swal.fire({
          icon: 'warning',
          title: 'Peringatan',
          text: 'Harap centang kotak untuk menyatakan bahwa Anda sudah mengisi form ini dengan benar.',
          confirmButtonText: 'OK'
        });
        return false;
      }
      return true;
    }
  </script>
