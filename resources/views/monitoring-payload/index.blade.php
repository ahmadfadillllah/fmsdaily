@include('layout.head', ['title' => 'Monitoring Payload'])
@include('layout.sidebar')
@include('layout.header')

<style>

    @media (max-width: 768px) {
        .datatable-table thead th, .table thead th {
            font-size: 7pt;
    }
        .pagination {
            --bs-pagination-padding-x: 8px;
            --bs-pagination-padding-y: 1px;
            --bs-pagination-font-size: 11pt;
        }

        .dt-buttons.btn-group.flex-wrap {
            display: none;
        }
    }
</style>

@php
// Variabel untuk menghitung total di footer
$total_less_than_100 = 0;
$total_between_100_and_115 = 0;
$total_greater_than_115 = 0;
$total_max_payload = 0;
$count = 0;
$sum_2 =  0;
$count_a = 0;
$count_b = 0;
@endphp

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="row">
                        <form action="" method="get" class="w-100">
                            <div class="col-12 col-md-4 d-flex align-items-center">
                                <!-- Select Input -->
                                <div class="mb-3 me-2 w-100">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-select" data-trigger name="unit" id="unit">
                                        <option selected disabled></option>
                                        @foreach ($unit as $u)
                                            <option value="{{ $u->VHC_ID }}">{{ $u->VHC_ID }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success" style="font-size:16px;">Tampilkan</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th style="background-color:aquamarine;" rowspan="2">Unit</th>
                                        <th style="background-color:aquamarine;" colspan="3">Distribusi Payload</th>
                                        <th rowspan="2" style="word-wrap: break-word; white-space: normal;background-color:aquamarine;">
                                            Kejadian Payload
                                            > 115 T
                                          </th>
                                        <th rowspan="2" style="word-wrap: break-word; white-space: normal;background-color:aquamarine;">Maksimal Payload</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color:aquamarine;">< 100</th>
                                        <th style="background-color:aquamarine;">100 - 115</th>
                                        <th style="background-color:aquamarine;">> 115</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($payload as $py)
                                    @php
                                        $count++;
                                        if ($py['greater_than_115'] > 0) {
                                            $count_a++;
                                        }
                                        if ($py['max_payload'] > 0) {
                                            $count_b++;
                                        }
                                        $sum_2 = $py['less_than_100'] + $py['between_100_and_115'] + $py['greater_than_115'];

                                        // Menambahkan nilai ke total
                                        $total_less_than_100 += $py['less_than_100'];
                                        $total_between_100_and_115 += $py['between_100_and_115'];
                                        $total_greater_than_115 += $py['greater_than_115'];
                                        $total_max_payload += $py['max_payload'];
                                    @endphp
                                        <tr>
                                            <td>{{ $py['VHC_ID'] }}</td>
                                            <td style="text-align: center">{{ round($py['less_than_100'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['between_100_and_115'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['greater_than_115'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['greater_than_115'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['max_payload'], 1) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot style="background-color:moccasin">
                                    {{-- @dd($sum_2) --}}
                                    <tr>
                                        <td>%</td>
                                        <td style="text-align: center">{{ $sum_2 != 0 ? round($total_less_than_100 / $sum_2, 2 ) : 0 }}</td>
                                        <td style="text-align: center">{{ $sum_2 != 0 ? round($total_between_100_and_115 / $sum_2, 2 ) : 0 }}</td>
                                        <td style="text-align: center">{{ $sum_2 != 0 ? round($total_greater_than_115 / $sum_2, 2 ) : 0 }}</td>
                                        <td style="text-align: center">{{ $count_a != 0 ? round($total_greater_than_115 / $count_a, 1) : 0 }}</td>
                                        <td style="text-align: center">{{ $count_b != 0 ? round($total_max_payload / $count_b, 1) : 0 }}</td>
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
    // range picker
    (function () {
        const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-5'), {
            buttonClass: 'btn'
        });
    })();

</script>
<script>
    // [ HTML5 Export Buttons ]
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'print']
    });

    // [ Column Selectors ]
    $('#cbtn-selectors').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible'],

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
                orientation: 'portrait', // Set orientation menjadi landscape
                pageSize: 'A4', // Ukuran halaman (opsional, default A4)
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                    format: {
                        body: function(data, row, column, node) {
                            // Menghapus entitas HTML seperti &gt;
                            return data
                                .replace(/&lt;/g, '<')   // Mengganti &lt; dengan <
                                .replace(/&gt;/g, '>')   // Mengganti &gt; dengan >
                                .replace(/&amp;/g, '&');
                        }
                    }

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

