@extends('layouts.main')
@section('title', 'Teams')
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
                    <i class="ik ik-shield bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Teams')}}</h5>
                        <span>{{ __('List of Teams')}}</span>
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
                            <a href="#">{{ __('Teams')}}</a>
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
                <div class="card-header">
                    <h3>{{ __('Teams')}}</h3>
                </div>
                <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                Teams
                                <!-- only those have manage_permission permission will get access -->
                                @can('manage_permission')
                                <a class="pull-right btn btn-default btn-sm" href="{{route('teams.create')}}">
                                    <i class="fa fa-plus"></i> Create team
                                </a>
                                @endcan
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                        <tr>
                                            <td>{{$team->name}}</td>
                                            <td>
                                                @if(auth()->user()->isOwnerOfTeam($team))
                                                <span class="label label-success">Owner</span>
                                                @else
                                                <span class="label label-primary">Member</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(is_null(auth()->user()->currentTeam) ||
                                                auth()->user()->currentTeam->getKey() !== $team->getKey())
                                                <a href="{{route('teams.switch', $team)}}"
                                                    class="btn btn-sm btn-default">
                                                    <i class="fa fa-sign-in"></i> Switch
                                                </a>
                                                @else
                                                <span class="label label-default">Current team</span>
                                                @endif

                                                <a href="{{route('teams.members.show', $team)}}"
                                                    class="btn btn-sm btn-default">
                                                    <i class="fa fa-users"></i> Members
                                                </a>

                                                @if(auth()->user()->isOwnerOfTeam($team))

                                                <a href="{{route('teams.edit', $team)}}" class="btn btn-sm btn-default">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>

                                                <form style="display: inline-block;"
                                                    action="{{route('teams.destroy', $team)}}" method="post">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                                                        Delete</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>



    </div>
</div>

@endsection
