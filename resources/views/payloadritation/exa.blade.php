@include('layout.head', ['title' => 'Payload & Ritation'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .table td, .table thead tr th {
    font-size: 14px;
    padding: 5px;
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
                                $payload_today_total = $item->sum('LOD_TONNAGE');
                                $volume_today_total = $item->sum('LOD_VOLUME');
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
                                                    <th rowspan="3">No. Unit</th>
                                                    <th>Load Tonnage</th>
                                                    <th>Load Volume</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach ($item as $dt)
                                                    <tr>
                                                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                                                        <td>{{ $dt->VHC_ID }}</td>
                                                        <td style="text-align: center;">{{ number_format($dt->LOD_TONNAGE, 2) }}</td>
                                                        <td style="text-align: center;">{{ number_format($dt->LOD_VOLUME, 2) }}</td>
                                                    </tr>

                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
                                                    <td style="text-align: center;">{{ number_format($payload_today_total, 2) }}</td>
                                                    <td style="text-align: center;">{{ number_format($volume_today_total, 2) }}</td>
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
    setTimeout(function() {
        location.reload();
    }, 300000); // 300000 milidetik = 5 menit
</script>

