@extends('layouts.main')
@section('title', 'Upload League Results')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Upload League Results')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Upload League Results')}}</a>
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
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Upload League Results')}}</h3>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" class="forms-sample" method="POST" action="{{ route('athlete.results.store', $league) }}" >
                            @csrf
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="proof_photo">{{ __('Photo Proof')}}<span class="text-red">*</span></label>
                                        <input id="proof_photo" type="file" accept="image/*" class="form-control @error('logo') is-invalid @enderror" name="proof_photo" value="{{ old('proof_photo') }}" required>
                                        <div class="help-block with-errors"></div>
                                        @error('proof_photo')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type">{{ __('Type')}}<span class="text-red">*</span></label>
                                        <input disabled id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type', $league->machine_type) }}" placeholder="Distance in meters"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="workout_date">{{ __('Workout Date')}}<span class="text-red">*</span></label>
                                        <input min="{{ $league->registration_start_date }}" max="{{ $league->registration_expiration_date }}" id="workout_date" type="date" class="form-control @error('workout_date') is-invalid @enderror" name="workout_date" value="{{ old('workout_date') }}"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('workout_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="distance">{{ __('Distance')}}<span class="text-red">*</span></label>
                                        <input id="distance" type="number" class="form-control @error('distance') is-invalid @enderror" name="distance" value="{{ old('distance') }}" placeholder="Distance in meters"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('distance')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="hours">{{ __('Hours')}}<span class="text-red">*</span></label>
                                        <input id="hours" type="number" class="form-control @error('hours') is-invalid @enderror" name="hours" value="{{ old('hours') }}"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('hours')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="minutes">{{ __('Minutes')}}<span class="text-red">*</span></label>
                                        <input id="minutes" type="number" class="form-control @error('minutes') is-invalid @enderror" name="minutes" value="{{ old('minutes') }}"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('minutes')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="seconds">{{ __('Seconds')}}<span class="text-red">*</span></label>
                                        <input id="seconds" type="number" class="form-control @error('seconds') is-invalid @enderror" name="seconds" value="{{ old('seconds') }}"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('seconds')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="tenths">{{ __('tenths')}}<span class="text-red">*</span></label>
                                        <input id="tenths" type="number" class="form-control @error('tenths') is-invalid @enderror" name="tenths" value="{{ old('tenths') }}"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('tenths')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="weight_class">{{ __('Weight Class')}}<span class="text-red">*</span></label>
                                        <input disabled type="text" id="weight_class" class="form-control @error('weight_class') is-invalid @enderror" name="weight_class" value="{{ old('weight_class', $league->category) }}">
                                        <div class="help-block with-errors"></div>
                                        @error('weight_class')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="comments">{{ __('Comments')}}<span class="text-red">*</span></label>
                                        <textarea id="comments" type="text" class="form-control @error('comments') is-invalid @enderror" name="comments" required>{{ old('comments') }}</textarea>
                                        <div class="help-block with-errors"></div>

                                        @error('comments')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script src="{{ asset('js/form-advanced.js') }}"></script>
    @endpush
@endsection
