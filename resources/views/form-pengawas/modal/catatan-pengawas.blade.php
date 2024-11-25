<div class="modal fade" id="tambahCatatan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Catatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCatatan">
                    <div class="mb-3">
                        <label for="start" class="form-label">Start</label>
                        <input type="time" class="form-control" id="start_catatan" name="jam_start[]">
                    </div>
                    <div class="mb-3">
                        <label for="end" class="form-label">End</label>
                        <input type="time" class="form-control" id="end_catatan" name="jam_stop[]">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description_catatan" name="keterangan[]" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveCatatan">Tambah</button>
            </div>
        </div>
    </div>
</div>
