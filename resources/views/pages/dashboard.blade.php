@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
@endpush

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-12">
                <div class="page-header-title">
                    <i class="ik ik-home bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Dashboard')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- page statustic chart start -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-red text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-12">
                            {{Auth::user()->email}}
                        </div>
                    </div>
                    <div>
                        {{Auth::user()->name}}
                    </div>
                    <div>
                        {{Auth::user()->firstname}} {{Auth::user()->surname}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-blue text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-12">
                            @if(Auth::user()->currentTeam) {{Auth::user()->currentTeam->name}} @else No team yet @endif
                        </div>
                    </div>
                    <!--<div class="col-12">
                            @if(Auth::user()->currentTeam)  {{Auth::user()->currentTeam->owner->username}} @else No team yet @endif
                        </div>-->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-green text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">

                        </div>
                        <div class="col-4 text-right">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-yellow text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">

                        </div>
                        <div class="col-4 text-right">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- page statustic chart start -->
        <div class="col-xl-12 col-md-12">
            <div class="card card-yellow text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">

                        </div>
                        <div class="col-4 text-right">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
<!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
<script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

<script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
<script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>


<script src="{{ asset('js/widget-statistic.js') }}"></script>
<script src="{{ asset('js/widget-data.js') }}"></script>
<script src="{{ asset('js/dashboard-charts.js') }}"></script>

@endpush
@endsection
