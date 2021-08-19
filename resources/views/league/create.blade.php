@extends('layouts.main')
@section('title', 'Add League')
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
                            <h5>{{ __('Add League')}}</h5>
                            <span>{{ __('Create new League and assign athlete')}}</span>
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
                                <a href="#">{{ __('Add League')}}</a>
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
                        <h3>{{ __('Add League')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('league.store') }}" >
                            @csrf
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Enter league name" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type">{{ __('Type')}}<span class="text-red">*</span></label>
                                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                                            <option selected value="{{ \App\Models\League::TYPE_OPEN }}">{{ \App\Models\League::TYPE_OPEN }}</option>
                                            <option value="{{ \App\Models\League::TYPE_PRIVATE }}">{{ \App\Models\League::TYPE_PRIVATE }}</option>
                                        </select>
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
                                        <label for="business">{{ __('Business')}}<span class="text-red">*</span></label>
                                        <input id="business" type="text" class="form-control @error('business') is-invalid @enderror" name="business" value="" required>
                                        <div class="help-block with-errors"></div>
                                        @error('business')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="category">{{ __('Category')}}<span class="text-red">*</span></label>
                                        <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" required>
                                            <option selected value="{{ \App\Models\League::TYPE_LIGHT_WEIGHT }}">{{ \App\Models\League::TYPE_LIGHT_WEIGHT }}</option>
                                            <option value="{{ \App\Models\League::TYPE_HEAVY_WEIGHT }}">{{ \App\Models\League::TYPE_HEAVY_WEIGHT }}</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('category')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gender">{{ __('Gender')}}<span class="text-red">*</span></label>
                                        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                            <option selected value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="age">{{ __('Age')}}<span class="text-red">*</span></label>
                                        <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="" placeholder="Age in years eg 22" required>
                                        <div class="help-block with-errors"></div>
                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="athletes">{{ __('Athletes')}}<span class="text-red">*</span></label>
                                        <select multiple id="athletes" class="form-control select2 @error('athletes') is-invalid @enderror" name="athletes[]" required>
                                            @forelse($athletes as $athlete)
                                                <option value="{{ $athlete->id }}">{{ $athlete->name }} ({{ $athlete->email }})</option>
                                            @empty
                                                <option>No Athlete Found</option>
                                            @endforelse

                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('athletes')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="allow_join">{{ __('Allow Join?')}}<span class="text-red">*</span></label>
                                        <input type="hidden" name="allow_join" value="0">
                                        <br>
                                        <input value="1" id="allow_join" class="form-control js-single @error('allow_join') is-invalid @enderror" name="allow_join" type="checkbox" autofocus />
                                        <div class="help-block with-errors"></div>
                                        @error('allow_join')
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
