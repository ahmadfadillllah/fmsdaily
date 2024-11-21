<div class="modal fade" id="tambahSupportModal" tabindex="-1" aria-labelledby="modalSupportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSupportLabel">Alat Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSupport">
                    <div class="mb-3">
                        <label>Jenis</label>
                        <select class="form-select" id="jenisSupport" required name="jenisSupport[]">
                            <option selected disabled>Pilih jenis support</option>
                            <option value="BD">BD</option>
                            <option value="MG">MG</option>
                            <option value="EX">EX</option>
                            <option value="HD">HD</option>
                            <option value="WT">WT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nomor Unit</label>
                        <select class="form-select" id="unitSupport" name="nomorUnitSupport[]" required>
                            <option selected disabled>Pilih unit</option>
                            <option value="Dummy Unit">Dummy Unit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>NIK Operator</label>
                        <input type="text" id="nikSupport" class="form-control" name="nikOperatorSupport[]" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Operator</label>
                        <input type="text" id="namaSupport" class="form-control" name="namaOperatorSupport[]">
                    </div>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="text" id="tanggalSupport" class="form-control" name="tanggalSupport[]" required>
                    </div>
                    <div class="mb-3">
                        <label>Shift</label>
                        <select class="form-select" id="shiftSupport" name="shiftSupport[]" required>
                            <option selected disabled>Pilih shift</option>
                            <option value="Siang">Siang</option>
                            <option value="Malam">Malam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>HM Awal</label>
                        <input type="number" id="hmAwalSupport" class="form-control" name="hmAwalSupport[]" required>
                    </div>
                    <div class="mb-3">
                        <label>HM Akhir</label>
                        <input type="number" id="hmAkhirSupport" class="form-control" name="hmAkhirSupport[]" required>
                    </div>
                    <div class="mb-3">
                        <label>Total</label>
                        <input type="number" id="totalSupport" class="form-control" name="totalSupport[]" readonly>
                    </div>
                    <div class="mb-3">
                        <label>HM Cash</label>
                        <input type="text" id="hmCashSupport" class="form-control" name="hmCashSupport[]">
                    </div>

                    <div class="mb-3">
                        <label>Material</label>
                        <select id="materialSupport" class="form-select" name="materialSupport[]">
                            <option selected disabled>Pilih material</option>
                            @foreach ($data['material'] as $mat)
                                <option value="{{ $mat->MAT_ID }}">{{ $mat->MAT_DESC }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveSupport" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
