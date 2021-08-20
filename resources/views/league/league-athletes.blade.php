@extends('layouts.main')
@section('title', 'League Athletes')
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
                            <h5>{{ __('League Athletes')}}</h5>
                            <span>{{ __('List of League Athletes')}}</span>
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
                                <a href="#">{{ __('League Athletes')}}</a>
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
                    <div class="card-header"><h3>{{ __('League Athletes')}}</h3></div>
                    <div class="card-body">
                        <table id="league_table" class="table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('First Name')}}</th>
                                <th>{{ __('Surname')}}</th>
                                <th>{{ __('Email')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($athletes as $athlete)
                                <tr>
                                    <td>{{ $athlete->name }}</td>
                                    <td>{{ $athlete->firstname }}</td>
                                    <td>{{ $athlete->surname }}</td>
                                    <td>{{ $athlete->email }}</td>
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
