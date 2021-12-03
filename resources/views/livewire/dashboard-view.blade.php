<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Dashboard </h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Dashboard </li>
                        {{-- <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- {!! Avatar::create(Auth::user()->name)->setFontSize(20)->setDimension(40)->toSvg(); !!} --}}
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        Dashboard
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
