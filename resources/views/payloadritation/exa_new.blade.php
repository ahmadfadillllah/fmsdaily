@include('layout.head', ['title' => 'Payload & Ritation'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .table td, .table thead tr th {
    font-size: 11px;  /* Ukuran font lebih kecil */
    padding: 5px;     /* Mengurangi padding */
}
.table-container {
    overflow-x: auto;
    width: 100%;
}

#cbtn-selectors th, #cbtn-selectors td {
    white-space: nowrap;
}

#cbtn-selectors tbody tr td:nth-child(2){
    position: sticky;
    left: 0;
    background-color: #fff; /* Optional: to ensure it's not transparent */
    z-index: 3; /* To make sure the fixed columns are above the others */
}

#cbtn-selectors th {
    background-color: #f8f9fa; /* Light background for header */
}


</style>
@php
    $dataCount = count($grouped);

    $totalPayloadLastHour = 0;
    $totalPayloadShift = 0;
    $totalPayloadShiftAve = 0;
    $totalPayloadToday = 0;
    $totalPayloadLess85 = 0;
    $totalPayload95100 = 0;
    $totalPayloadMore110 = 0;
    $totalRitAvgLast3Hour = 0;
    $totalRitAvgShift = 0;
    $totalRitAvgToday = 0;
    $totalRitLastHour = 0;
    $totalRitShift = 0;
    $totalRitShiftAve = 0;
    $totalRitToday = 0;
    $totalRitLast3Hour = 0;
    $countPayloadShift = 0;
@endphp

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Payload & Ritation</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Excavator</a></li>
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
                    <div class="card-body">
                        <h5>Resume Summary per EX</h5>
                        <div class="dt-responsive table-responsive">
                            <table id="dom-jqry" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;background-color:aquamarine">
                                    <tr>
                                        <th>No</th>
                                        <th>Fleet</th>
                                        <th style="text-align: center;">Payload</th>
                                        <th style="text-align: center;">Ritation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped as $key => $dt)
                                        <tr>
                                            <td style="text-align: center;font-size: 14px;">{{ $loop->iteration }}</td>
                                            <td style="font-size: 14px;">{{ $dt['ASG_LOADERID'] }}</td>
                                            <td style="text-align: center;font-size: 14px;">{{ number_format($dt['PAYLOAD_SHIFT'], 0) }}</td>
                                            <td style="text-align: center;font-size: 14px;">{{ number_format($dt['RIT_SHIFT'], 0) }}</td>
                                        </tr>
                                        @php
                                            // Menghitung total PAYLOAD_SHIFT yang lebih besar dari 0
                                            if ($dt['PAYLOAD_SHIFT'] > 0) {
                                                $totalPayloadShiftAve += $dt['PAYLOAD_SHIFT'];
                                                $countPayloadShift++; // Menambah hitungan untuk yang bukan 0
                                            }

                                            // Menghitung total RIT_SHIFT (tidak ada pengecekan nilai 0)
                                            $totalRitShiftAve += $dt['RIT_SHIFT'];
                                        @endphp
                                    @endforeach
                                </tbody>

                                <tfoot style="background-color:moccasin">
                                    <tr>
                                        <td colspan="2" style="text-align: center; font-weight: bold;font-size: 14px;">Total</td>
                                        <td style="text-align: center;font-size: 14px;">
                                            {{-- Menghitung rata-rata untuk PAYLOAD_SHIFT hanya jika ada nilai yang valid (lebih besar dari 0) --}}
                                            @if ($countPayloadShift > 0)
                                                {{ number_format($totalPayloadShiftAve / $countPayloadShift, 0) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td style="text-align: center;font-size: 14px;">
                                            {{-- Menampilkan total RIT_SHIFT (tidak ada rata-rata untuk RIT_SHIFT) --}}
                                            {{ number_format($totalRitShiftAve, 0) }}
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>All Summary per EX</h5>
                        <div class="dt-responsive table-responsive table-container">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th rowspan="3" style="background-color:aquamarine;">No</th>
                                        <th rowspan="3" style="background-color:aquamarine;">Fleet</th>
                                        <th style="text-align: center;background-color:aquamarine;" colspan="5">Payload</th>
                                        <th style="text-align: center;background-color:aquamarine;" colspan="4">Ritation</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;background-color:aquamarine;" colspan="2">Average</th>
                                        <th style="text-align: center;background-color:aquamarine;" colspan="3">Distribution</th>
                                        <th style="text-align: center;background-color:aquamarine;" colspan="2">Average</th>
                                        <th style="text-align: center;background-color:aquamarine;" colspan="2">Cummulative</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color:aquamarine;">Last Hour</th>
                                        <th style="background-color:aquamarine;">This Shift</th>
                                        <th style="background-color:aquamarine;">< 95</th>
                                        <th style="background-color:aquamarine;">95 - 110</th>
                                        <th style="background-color:aquamarine;">> 110</th>
                                        <th style="background-color:aquamarine;">Last Hour</th>
                                        <th style="background-color:aquamarine;">This Shift</th>
                                        <th style="background-color:aquamarine;">Last Hour</th>
                                        <th style="background-color:aquamarine;">This Shift</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped as $key => $dt)
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                            <td>{{ $dt['ASG_LOADERID'] }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['PAYLOAD_LASTHOUR'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['PAYLOAD_SHIFT'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['PAYLOAD_8595'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['PAYLOAD_95100'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['PAYLOAD_MORE110'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['RIT_LASTHOUR'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['RITAVG_SHIFT'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['RIT_LASTHOUR'], 0) }}</td>
                                            <td style="text-align: center;">{{ number_format($dt['RIT_SHIFT'], 0) }}</td>
                                        </tr>
                                        @php
                                            $totalPayloadLastHour += $dt['PAYLOAD_LASTHOUR'];
                                            $totalPayloadShift += $dt['PAYLOAD_SHIFT'];
                                            $totalRitLast3Hour += $dt['RIT_LAST3HOUR'];
                                            $totalPayloadLess85 += $dt['PAYLOAD_8595'];
                                            $totalPayload95100 += $dt['PAYLOAD_95100'];
                                            $totalPayloadMore110 += $dt['PAYLOAD_MORE110'];
                                            $totalRitAvgLast3Hour += $dt['RIT_LASTHOUR'];
                                            $totalRitAvgShift += $dt['RITAVG_SHIFT'];
                                            $totalRitLastHour += $dt['RIT_LASTHOUR'];
                                            $totalRitShift += $dt['RIT_SHIFT'];
                                        @endphp
                                    @endforeach

                                </tbody>
                                <tfoot style="background-color:moccasin">
                                    <tr>
                                        <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
                                        <td style="text-align: center;">
                                            {{ $countPayloadShift != 0 ? number_format($totalPayloadLastHour / $countPayloadShift, 0) : 0 }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $countPayloadShift != 0 ? number_format($totalPayloadShift / $countPayloadShift, 0) : 0 }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalPayloadLess85, 0) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalPayload95100, 0) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalPayloadMore110, 0) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalRitAvgLast3Hour, 0) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalRitAvgShift, 0) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalRitLastHour, 0) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format($totalRitShift, 0) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
        ],
        "pageLength": 15,
        fixedColumns: {
        start: 2,
        end: 1
    },
    paging: false,
    scrollCollapse: true,
    scrollX: true,
    scrollY: 300
    });

    // [ Excel - Cell Background ]
    $('#excel-bg').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['hallo.xml'];
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



