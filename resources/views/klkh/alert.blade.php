<div class="modal fade" id="alertVerifikasi" aria-hidden="true" aria-labelledby="..." tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon
                    src="/tdrtiskw.json"
                    trigger="loop"
                    colors="primary:#f7b84b,secondary:#405189"
                    style="width:130px;height:130px">
                </lord-icon>
                <div class="pt-4">
                    <h4>Anda yakin ingin memverifikasi semua KLKH pada tanggal yang dipilih?</h4>
                    <p class="text-muted">Data yang sudah diverifikasi tidak bisa diubah!</p>
                    <!-- Toogle to second dialog -->
                    <a href="{{ route('verifikasi.klkh.all') }}"><span class="badge" style="font-size:14px;background-color:#001932">Verifikasi</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
