@extends('layouts.main')
@section('title', 'Leagues')
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
                            <h5>{{ __('League Leaderboard')}}</h5>
                            
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
                                <a href="{!! route('leagues.myleagues') !!}">{{ __('Leagues')}}</a>
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
                    <div class="card-header"><h3>{{ __('Leaderboard')}}</h3></div>
                    <div class="card-body">
                        <table id="league_table" class="table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('Place')}}</th>
                                <th>{{ __('Row')}}</th>
                                <th>{{ __('Timing')}}</th>
                                <th>{{ __('First Name')}}</th>
                                <th>{{ __('Last Name')}}</th>
                                <th>{{ __('Gender')}}</th>
                                <th>{{ __('Age')}}</th>
                                <th>{{ __('Machine type')}}</th>
                              
                               
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($athletes as $athlete)
                            <?php $athlete_data = App\User::where('id',$athlete->athlete_id)->first(); ?>
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $league->distance }}m</td>
                                    <td>{{ $athlete->hours }}:{{ $athlete->minutes }}:{{ $athlete->seconds }}</td>
                                    <td>{{ $athlete_data->firstname }}</td>
                                    <td>{{ $athlete_data->surname }}</td>
                                    <td>{{ $league->gender }}</td>
                                    <td>{{ $league->age }}</td>
                                    <td>{{ $league->machine_type }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Results Found</td>
                                </tr>
                            @endforelse
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
