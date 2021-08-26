@extends('layouts.main')
@section('title', 'Leagues Results')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Leagues Results')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Leagues Results')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('Leagues Results')}}</h3></div>
                    <div class="card-body">
                        <table id="league_table" class="table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('Proof')}}</th>
                                <th>{{ __('League Name')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Weight Class')}}</th>
                                <th>{{ __('Total Time')}}</th>
                                <th>{{ __('Distance')}}</th>
                                <th>{{ __('Workout Date')}}</th>
                                <th>{{ __('Comments')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="{{ $result->proof_url }}"><img width="50px" src="{{ $result->proof_url }}"></a></td>
                                <td>{{ $result->league->name }}</td>
                                <td>{{ $result->type }}</td>
                                <td>{{ $result->weight_class }}</td>
                                <td>{{ $result->hours.'H' }} {{ $result->minutes.'M' }} {{ $result->seconds.'S' }} {{ $result->tenths.'T' }}</td>
                                <td>{{ $result->distance }} M</td>
                                <td>{{ $result->workout_date }}</td>
                                <td>{{ $result->comments }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <!--server side users table script-->
        <script src="{{ asset('js/custom.js') }}"></script>
    @endpush
@endsection
