@extends('layouts.main')
@section('title', 'Data Tables')
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
                        <i class="ik ik-shield bg-green"></i>
                        <div class="d-inline">
                            <h5>{{ __('Athletic in Team Table')}}</h5>
                            <span>{{ __('List of Athletic are part of the team')}}</span>
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
                                <a href="#">Athletic Team</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Table</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        <h3>Athletic</h3>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('First Name')}}</th>
                                        <th>{{ __('Surname')}}</th>
                                        <th>{{ __('Username')}}</th>
                                        <th>{{ __('Team')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamlist as $row)
                                    <tr>
                                        <td>{{ $row->first_name }}</td>
                                        <td>{{ $row->surname }}</td>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ $row->team }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>{{ __('First Name')}}</th>
                                        <th>{{ __('Surname')}}</th>
                                        <th>{{ __('Username')}}</th>
                                        <th>{{ __('Team')}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


















    </div>
    <!-- push external js -->
     @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
@endsection