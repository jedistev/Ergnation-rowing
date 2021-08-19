@extends('layouts.main')
@section('title', 'Profile')
@section('content')


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
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
                                <a href="#">{{ __('Pages')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="../img/user.jpg" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{Auth::user()->name}}</h4>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">{{ __('User Name')}} </small>
                        <h6>{{Auth::user()->name}}</h6>
                        <small class="text-muted d-block">{{ __('Full Name')}} </small>
                        <h6>{{Auth::user()->firstname}} {{Auth::user()->surname}}</h6>
                        <small class="text-muted d-block">{{ __('Email address')}} </small>
                        <h6>{{Auth::user()->email}}</h6>
                        <small class="text-muted d-block">{{ __('Team')}} </small>
                        <h6> @if(Auth::user()->currentTeam) {{Auth::user()->currentTeam->name}} @else No team yet @endif</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('Setting')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                        <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ url('/profile') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user = auth()->user()}}">
                                    <div class="form-group">
                                        <label for="example-name">{{ __('User Name')}}</label>
                                        <input type="text" placeholder="{{Auth::user()->name}}" class="form-control" name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-name">{{ __('First Name')}}</label>
                                        <input type="text" placeholder="{{Auth::user()->firstname}}" class="form-control" name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-name">{{ __('Surname')}}</label>
                                        <input type="text" placeholder="{{Auth::user()->surname}}" class="form-control" name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-name">{{ __('Team')}}</label>
                                        <input type="text" placeholder="@if(Auth::user()->currentTeam) {{Auth::user()->currentTeam->name}} @else No team yet @endif" class="form-control" name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">{{ __('Email')}}</label>
                                        <input type="email" placeholder="{{Auth::user()->email}}" class="form-control" name="example-email" id="example-email">
                                    </div>
                                    <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary form-control-right">{{ __('Update')}}</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">

                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
