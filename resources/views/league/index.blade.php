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
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Allow Join')}}</th>
                                <th>{{ __('Business')}}</th>
                                <th>{{ __('Category')}}</th>
                                <th>{{ __('Gender')}}</th>
                                <th>{{ __('Age')}}</th>
                                <th>{{ __('Athletes')}}</th>
                                <th>{{ __('Created By')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($leagues as $league)
                                <tr>
                                    <td>{{ $league->name }}</td>
                                    <td>{{ $league->type }}</td>
                                    <td>{{ $league->allow_join_for_human }}</td>
                                    <td>{{ $league->business }}</td>
                                    <td>{{ $league->category }}</td>
                                    <td>{{ $league->gender }}</td>
                                    <td>{{ $league->age }}</td>
                                    <td>{{ $league->athletes_count }}</td>
                                    <td>{{ $league->user->name }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                            <a ><i class="ik ik-trash-2 f-16 text-red"></i></a>
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
