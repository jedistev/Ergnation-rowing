@extends('layouts.main')
@section('title', 'My Leagues')
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
                            <h5>{{ __('Leagues')}}</h5>
                            <span>{{ __('List of Leagues')}}</span>
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
                                <a href="#">{{ __('Leagues')}}</a>
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
                    <div class="card-header"><h3>{{ __('Leagues')}}</h3></div>
                    <div class="card-body">
                        <table id="league_table" class="table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('Logo')}}</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Machine Type')}}</th>
                                <th>{{ __('Business')}}</th>
                                <th>{{ __('Category')}}</th>
                                <th>{{ __('Start Date')}}</th>
                                <th>{{ __('End Date')}}</th>
                                <th>{{ __('Race Date')}}</th>
                                <th>{{ __('Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($leagues as $league)
                                <tr>
                                    <td><img src="{{ $league->logo_url }}" width="50px"></td>
                                    <td>{{ $league->name }}</td>
                                    <td>{{ $league->type }}</td>
                                    <td>{{ $league->machine_type }}</td>
                                    <td>{{ $league->business }}</td>
                                    <td>{{ $league->category }}</td>
                                    <td>{{ $league->registration_start_date }}</td>
                                    <td>{{ $league->registration_expiration_date }}</td>
                                    <td>{{ $league->race_date }}</td>
                                    <td>
                                        <div class="table-actions">
                                            @if($league->results_count > 0)
                                                <a href="{{ route('athlete.results', $league) }}"><i data-toggle="tooltip" data-title="View My Result" class="ik ik-eye"></i></a>
                                            @else
                                                <a href="{{ route('athlete.results.create', $league) }}" ><i data-toggle="tooltip" data-title="Upload My Result" class="ik ik-upload"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Leagues Found</td>
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
