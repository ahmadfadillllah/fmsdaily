<div class="modal fade" id="editAlatSupport{{ $item->uuid }}" tabindex="-1" aria-labelledby="modalSupportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSupportLabel">Alat Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('alat-support.update', $item->uuid) }}" method="POST">
                @csrf
            <div class="modal-body">

                    <div class="mb-3">
                        <label>Nomor Unit</label>
                        <select class="form-select" name="alat_unit">
                            <option value="{{ $item->nomor_unit }}" selected>{{ $item->nomor_unit }}</option>
                            @foreach ($nomor_unit as $nu)
                            <option value="{{ $nu->VHC_ID }}">{{ $nu->VHC_ID }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nama Operator</label>
                        <select class="form-select"  name="nama_operator">
                            <option value="{{ $item->nik_operator }}|{{ $item->nama_operator }}" selected>{{ $item->nik_operator }}|{{ $item->nama_operator }}</option>
                            @foreach ($operator as $op)
                                <option value="{{ $op->NRP }}|{{ $op->PERSONALNAME }}">{{ $op->NRP }}|{{ $op->PERSONALNAME }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date"  class="form-control" value="{{ \Carbon\Carbon::parse($item->tanggal_operator)->format('Y-m-d') }}" name="tanggal_operator">


                    </div>
                    <div class="mb-3">
                        <label>Shift</label>
                        <select class="form-select" name="shift_operator">
                            <option selected value="{{ $item->shift_operator_id }}">{{ $item->shift_operator }}</option>
                            @foreach ($shift as $shh)
                                <option value="{{ $shh->id }}">{{ $shh->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>HM Awal</label>
                        <input type="number" class="form-control" name="hm_awal" value="{{ $item->hm_awal }}">
                    </div>
                    <div class="mb-3">
                        <label>HM Akhir</label>
                        <input type="number" class="form-control" name="hm_akhir" value="{{ $item->hm_akhir }}">
                    </div>
                    <div class="mb-3">
                        <label>Total</label>
                        <input type="number" class="form-control" name="hm_total" value="{{ number_format($item->hm_akhir - $item->hm_awal, 2) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>HM Cash</label>
                        <input type="number"class="form-control" name="hm_cash" value="{{ $item->hm_cash }}">
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="{{ $item->keterangan }}">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>


