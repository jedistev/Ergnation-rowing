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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            @include('include.message')

            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{Auth::user()->name}}</h4>
                        </div>
                    </div>
                    <hr class="mb-0">
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
                                <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('common.profile.update') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="avatar">{{ __('Avatar')}}</label>
                                        <input id="avatar" type="file" accept="image/*" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('logo') }}">
                                        <span class="text-muted">This will replace old avatar</span>
                                        <div class="help-block with-errors"></div>

                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">{{ __('Last Name')}}</label>
                                        <input type="text" value="{{Auth::user()->name}}" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">{{ __('First Name')}}</label>
                                        <input type="text" value="{{Auth::user()->firstname}}" class="form-control" name="firstname" id="firstname">
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">{{ __('Surname')}}</label>
                                        <input type="text" value="{{Auth::user()->surname}}" class="form-control" name="surname" id="surname">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-name">{{ __('Team')}}</label>
                                        <input disabled type="text" value="@if(Auth::user()->currentTeam) {{Auth::user()->currentTeam->name}} @else No team yet @endif" class="form-control" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}</label>
                                        <input type="email" value="{{Auth::user()->email}}" class="form-control" name="email" id="email">
                                    </div>
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
