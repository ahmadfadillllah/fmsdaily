<div class="accordion" id="accordionSupport">
    @forelse ($alatSupports as $key => $alat)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-{{ $key }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $key }}" aria-expanded="false"
                        aria-controls="collapse-{{ $key }}">
                    #{{ $key + 1 }}. {{ $alat->alat_unit }}
                </button>
            </h2>
            <div id="collapse-{{ $key }}" class="accordion-collapse collapse"
                 aria-labelledby="heading-{{ $key }}" data-bs-parent="#accordionSupport">
                <div class="accordion-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Unit</th>
                            <td>{{ $alat->alat_unit }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $alat->nik_operator }} | {{ $alat->nama_operator }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($alat->tanggal_operator)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Shift</th>
                            <td>{{ $data['shift']->where('id', $alat->shift_operator_id)->first()->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>HM Awal</th>
                            <td>{{ $alat->hm_awal }}</td>
                        </tr>
                        <tr>
                            <th>HM Akhir</th>
                            <td>{{ $alat->hm_akhir }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ $alat->hm_total }}</td>
                        </tr>
                        <tr>
                            <th>HM Cash</th>
                            <td>{{ $alat->hm_cash }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $alat->keterangan }}</td>
                        </tr>
                    </table>
                    <button class="btn btn-danger btn-sm" onclick="hapusAlatSupport('{{ $alat->id }}')">Hapus</button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center">Belum ada alat support yang ditambahkan.</p>
    @endforelse
</div>

<script>
    function hapusAlatSupport(id) {
        if (confirm('Apakah Anda yakin ingin menghapus alat support ini?')) {
            fetch(`/alat-support/${id}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Alat support berhasil dihapus.');
                        location.reload();
                    } else {
                        alert('Gagal menghapus alat support.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus alat support.');
                });
        }
    }
</script>
