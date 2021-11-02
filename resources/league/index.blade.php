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
                                <th>{{ __('Logo')}}</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Machine Type')}}</th>
                                <th>{{ __('Allow Join')}}</th>
                                <th>{{ __('Description')}}</th>
                                <th>{{ __('Category')}}</th>
                                <th>{{ __('Gender')}}</th>
                                <th>{{ __('Age Group')}}</th>
                                <th>{{ __('Athletes')}}</th>
                                <th>{{ __('Start Date')}}</th>
                                <th>{{ __('End Date')}}</th>
                                <th>{{ __('Race Date')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($leagues as $league)
                                <tr>
                                    <td><img src="{{ $league->logo_url }}" width="50px"></td>
                                    <td>{{ $league->name }}</td>
                                    <td>{{ $league->type }}</td>
                                    <td>{{ $league->machine_type }}</td>
                                    <td>{{ $league->allow_join ? 'Yes' : 'No' }}</td>
                                    <td>{{ $league->business }}</td>
                                    <td>{{ $league->category }}</td>
                                    <td>{{ $league->gender }}</td>
                                    <td>{{ $league->age }}</td>
                                    @if($league->athletes_count > 0)
                                        <td><a class="btn btn-link" href="{{ route('league.athletes', $league) }}">{{ $league->athletes_count }}</a></td>
                                    @else
                                        <td>0</td>
                                    @endif
                                    <td>{{ $league->registration_start_date }}</td>
                                    <td>{{ $league->registration_expiration_date }}</td>
                                    <td>{{ $league->race_date }}</td>
{{--                                    <td>{{ $league->user->name }}</td>--}}
                                    <td>
                                        <div class="table-actions">
                                            <form action="{{ route('league.destroy', $league) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('league.edit', $league) }}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-link" type="submit"><i class="ik ik-trash-2 f-16 text-red"></i></button>
                                            </form>
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
