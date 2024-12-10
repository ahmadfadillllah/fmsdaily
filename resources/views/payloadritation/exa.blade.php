@include('layout.head', ['title' => 'Payload & Ritation'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .table td, .table thead tr th {
    font-size: 11px;  /* Ukuran font lebih kecil */
    padding: 5px;     /* Mengurangi padding */
}
</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Payload & Ritation</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Summary per EX</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{ route('payloadritation.index') }}">
                                <span class="badge bg-primary" style="font-size:14px">All Summary</span>
                            </a>
                            <a href="{{ route('payloadritation.exa') }}">
                                <span class="badge bg-success" style="font-size:14px">Summary per EX</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body pc-component">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($data as $loader_id => $item)
                            @php
                                $payload_today_total = $item->sum('PAYLOAD_SHIFT');
                                $rit_today_total = $item->sum('RIT_TODAY');
                            @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne"><button
                                        class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loader_id }}"
                                        aria-expanded="false" aria-controls="flush-collapse{{ $loader_id }}">{{ $loader_id }}</button></h2>
                                <div id="flush-collapse{{ $loader_id }}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <table class="table table-striped">
                                            <thead style="text-align: center; vertical-align: middle;">
                                                <tr>
                                                    <th rowspan="3">No</th>
                                                    <th rowspan="3">Type</th>
                                                    <th rowspan="3">No. Unit</th>
                                                    <th>Payload</th>
                                                    <th>Ritation</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach ($item as $dt)
                                                    <tr>
                                                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                                                        <td>{{ $dt->EQU_TYPEID }}</td>
                                                        <td>{{ $dt->VHC_ID }}</td>
                                                        <td style="text-align: center;">{{ $dt->PAYLOAD_TODAY }}</td>
                                                        <td style="text-align: center;">{{ $dt->RIT_TODAY }}</td>
                                                    </tr>

                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: center; font-weight: bold;">Total</td>
                                                    <td style="text-align: center;">{{ $payload_today_total }}</td>
                                                    <td style="text-align: center;">{{ $rit_today_total }}</td>
                                                </tr>
                                            </tfoot>
                                          </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
<script>
    // Memuat ulang halaman setiap 5 menit (300.000 milidetik)
    setTimeout(function() {
        location.reload();
    }, 300000); // 300000 milidetik = 5 menit
</script>

<script>
    // [ HTML5 Export Buttons ]
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });

    // [ Column Selectors ]
    $('#cbtn-selectors').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape', // Set orientation menjadi landscape
                pageSize: 'A3', // Ukuran halaman (opsional, default A4)
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                },
                customize: function (doc) {
                    // Menyesuaikan margin atau pengaturan tambahan
                    doc.content[1].margin = [10, 10, 10, 10]; // Atur margin [kiri, atas, kanan, bawah]
                }
            },
            'colvis'
        ]
    });

    // [ Excel - Cell Background ]
    $('#excel-bg').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row c[r^="F"]', sheet).each(function () {
                    if ($('is t', this).text().replace(/[^\d]/g, '') * 1 >= 500000) {
                        $(this).attr('s', '20');
                    }
                });
            }
        }]
    });

    // [ Custom File (JSON) ]
    $('#pdf-json').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            text: 'JSON',
            action: function (e, dt, button, config) {
                var data = dt.buttons.exportData();
                $.fn.dataTable.fileSave(new Blob([JSON.stringify(data)]), 'Export.json');
            }
        }]
    });

</script>



