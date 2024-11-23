@include('layout.head', ['title' => 'Dashboard'])
@include('layout.sidebar')
@include('layout.header')

<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-lg-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Data Produksi Per Jam</h5>
                        </div>
                        <h5 class="text-end my-2">5.44% <span class="badge bg-success">+2.6%</span></h5>
                        <div id="customer-rate-graph"></div>
                    </div>
                </div>
            </div>
        </div><!-- [ Main Content ] end -->
    </div>
</div>

@include('layout.footer')
