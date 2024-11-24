@include('layout.head', ['title' => 'Dashboard'])
@include('layout.sidebar')
@include('layout.header')

<div class="pc-container">
    <div class="pc-content">

        <div class="row">
            <div id="notifier" class="notifier-container">
                <span id="notification-message"></span>

            </div>
            <!-- [ sample-page ] start -->
            <div class="col-lg-12 col-xxl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Data Produksi Per Jam</h5>
                            <p class="mb-0">{{ now()->timezone('Asia/Makassar')->format('l, d F Y') }} WITA</p>
                        </div>
                        {{-- <h5 class="text-end my-2">5.44% <span class="badge bg-success">+2.6%</span></h5> --}}
                        <div id="production-per-hour-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center my-3">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-success"><i class="ti ti-list-check f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0">Produksi Overburden</h5>
                            </div>
                        </div>
                        <div class="my-3">
                            <p class="mb-2">Tasks done <span class="float-end">{{ number_format($data['plan'] != 0 ? ($data['actual'] / $data['plan']) * 100 : 0, 2) }}%</span></p>
                            <div class="progress progress-primary">
                                <div class="progress-bar" role="progressbar"
                                style="width: {{ number_format($data['plan'] != 0 ? ($data['actual'] / $data['plan']) * 100 : 0, 2) }}%"
                                aria-valuenow="{{ number_format($data['plan'] != 0 ? ($data['actual'] / $data['plan']) * 100 : 0, 2) }}"
                                aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($data['plan'] != 0 ? ($data['actual'] / $data['plan']) * 100 : 0, 2) }}%
                            </div>
                            </div>
                        </div>
                        <div class="d-grid gap-3"><a href="#" class="btn btn-link-secondary">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="flex-shrink-0"><span class="p-1 d-block bg-warning rounded-circle"></span></div> --}}
                                    <div class="flex-grow-1 mx-2">
                                        <p class="mb-0 d-grid text-start"><span
                                                class="text-truncate w-100">Actual</span></p>
                                    </div>
                                    <div class="badge bg-light-dark f-12"> {{ number_format($data['actual'], 0, ',', '.') }} BCM
                                    </div>
                                </div>
                            </a><a href="#" class="btn btn-link-secondary">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="flex-shrink-0"><span class="p-1 d-block bg-primary rounded-circle"></span></div> --}}
                                    <div class="flex-grow-1 mx-2">
                                        <p class="mb-0 d-grid text-start"><span class="text-truncate w-100">Plan</span></p>
                                    </div>
                                    <div class="badge bg-light-dark f-12"> {{ number_format($data['plan'], 0, ',', '.') }} BCM
                                    </div>
                                </div>
                            </a></div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Siang</h5>
                        </div>
                        <div class="card-body pc-component">
                           @foreach ($data['kategori']['Siang'] as $item)
                            <div class="row mb-4">
                                <div class="col-12 col-md-2">
                                    <label for="">{{ $item['HOUR'] }}:00</label>
                                </div>
                                <div class="col-12 col-md-10">
                                    <div class="progress" style="height: 20px">
                                        <div class="progress-bar
                                        @if (number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) < 80) bg-danger
                                        @elseif(number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) > 80 ) bg-success
                                        @elseif(number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) == 80 ) bg-warning
                                        @endif" role="progressbar" style="width: {{ number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) }}%"
                                            aria-valuenow="{{ number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                           @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Malam</h5>
                        </div>
                        <div class="card-body pc-component">
                           @foreach ($data['kategori']['Malam'] as $item)
                            <div class="row mb-4">
                                <div class="col-12 col-md-2">
                                    <label for="">{{ $item['HOUR'] }}:00</label>
                                </div>
                                <div class="col-12 col-md-10">
                                    <div class="progress" style="height: 20px">
                                        <div class="progress-bar
                                        @if (number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) < 80) bg-danger
                                        @elseif(number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) > 80 ) bg-success
                                        @elseif(number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) == 80 ) bg-warning
                                        @endif" role="progressbar" style="width: {{ number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) }}%"
                                            aria-valuenow="{{ number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($item['PLAN_PRODUCTION'] != 0 ? ($item['PRODUCTION'] / $item['PLAN_PRODUCTION']) * 100 : 0, 2) }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                           @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- [ Main Content ] end -->
    </div>
</div>

@include('layout.footer')

<script>
    "use strict";

    function floatchart() {
        const productionData = @json($data['all']); // Data dari server
        const dataSeries = productionData.map(item => item.PRODUCTION);

        new ApexCharts(document.querySelector("#production-per-hour-chart"), {
            chart: {
                type: "area",
                height: 230,
                toolbar: {
                    show: !1
                }
            },
            colors: ["#0d6efd"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: !1,
                    opacityFrom: .5,
                    opacityTo: 0
                }
            },
            dataLabels: {
                enabled: 1
            },
            stroke: {
                width: 1
            },
            plotOptions: {
                bar: {
                    columnWidth: "45%",
                    borderRadius: 4
                }
            },
            grid: {
                strokeDashArray: 4
            },
            series: [{
                name: "Production",
                data: dataSeries
            }],
            xaxis: {
                categories: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00",
                    "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00",
                    "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"
                ],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                }
            }

        }).render();

    }
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            floatchart()
        }, 500)
    });

</script>
