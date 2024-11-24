@include('layout.head', ['title' => 'Dashboard'])
@include('layout.sidebar')
@include('layout.header')



<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="mb-0">Selamat datang, {{ Auth::user()->name }}!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div id="notifier" class="notifier-container">
                        <span id="notification-message"></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layout.footer')
