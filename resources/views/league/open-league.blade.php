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
{{--                                <th>{{ __('Description')}}</th>--}}
                                <th>{{ __('Distance')}}</th>
                                <th>{{ __('Category')}}</th>
{{--                                <th>{{ __('Gender')}}</th>--}}
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
{{--                                    <td>{{ $league->business }}</td>--}}
                                    <td>{{ $league->distance }}M</td>
                                    <td>{{ $league->category }}</td>
{{--                                    <td>{{ $league->gender }}</td>--}}
                                    <td>{{ $league->age }}</td>
                                    @if($league->athletes_count > 0)
                                        <td><a class="btn btn-link" href="{{ route('league.athletes', $league) }}">{{ $league->athletes_count }}</a></td>
                                    @else
                                        <td><a class="btn btn-link" href="#">0</a></td>
                                    @endif
                                    <td>{{ $league->registration_start_date }}</td>
                                    <td>{{ $league->registration_expiration_date }}</td>
                                    <td>{{ $league->race_date }}</td>
{{--                                    <td>{{ $league->user->name }}</td>--}}
                                    <td>
                                    
                            <?php
                            $nowday = date('Y-m-d');
                            $start_date = $league->registration_start_date;
                            $expiration_date = $league->registration_expiration_date;
                            ?>
                            @if (($nowday >= $start_date) && ($nowday <= $expiration_date))
                                <div class="table-actions">
                                    <?php
                                    $already = DB::table('athlete_league')->where('league_id', $league->id)->where('athlete_id',Auth::user()->id)->count();
                                    ?>
                                    @if($already == 0)
                                        <a href="javascript:void(0)" id="Leaguebtn_{{ $league->id }}" class="LeagueRegister btn-sm btn-success" data-id="{{ $league->id }}" style="color:#fff;" >Join</a>
                                    @else
                                        <a href="javascript:void(0)" id="Leaguebtn_{{ $league->id }}" class="LeagueLeave btn-sm btn-danger" data-id="{{ $league->id }}" style="color:#fff;" >Leave</a>
                                    @endif


                                </div>
                            @endif

                            <a href="{!! route('league.leaderboard',$league->id)!!}" class=" btn-info btn-sm">Preview</a> 
                                     

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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">

$(document).on("click",".LeagueRegister", function(event){ 
            event.preventDefault();
            const leagueid = $(this).data("id");
            swal({
                title: 'Are you sure',
                    text: 'you want to register for this League?',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {

                     jQuery.ajax({
                       type:"GET",
                       url:"{!! route('leagues.joinLeague')!!}?leagueid="+leagueid,
                       beforeSend: function()
                              {
                                  
                              },
                       success:function(res){               
                        if(res){
                            
                            $("#Leaguebtn_"+leagueid).text('leave');
                            
                            $("#Leaguebtn_"+leagueid).addClass("LeagueLeave");
                            $("#Leaguebtn_"+leagueid).addClass("btn-danger");
                            $("#Leaguebtn_"+leagueid).removeClass("LeagueRegister");
                            $("#Leaguebtn_"+leagueid).removeClass("btn-success");

                        }else{
                           
                        }
                       }
                    });

                }
            });
        });



$(document).on("click",".LeagueLeave", function(event){ 
            event.preventDefault();
            const leagueid = $(this).data("id");
            swal({
                title: 'Are you sure',
                    text: 'you want to leave this League?',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {

                     jQuery.ajax({
                       type:"GET",
                       url:"{!! route('leagues.LeaveLeague')!!}?leagueid="+leagueid,
                       beforeSend: function()
                              {
                                  
                              },
                       success:function(res){               
                        if(res){
                            
                            $("#Leaguebtn_"+leagueid).text('Join')

                            $("#Leaguebtn_"+leagueid).addClass("LeagueRegister");
                            $("#Leaguebtn_"+leagueid).addClass("btn-success");

                            $("#Leaguebtn_"+leagueid).removeClass("LeagueLeave");
                            $("#Leaguebtn_"+leagueid).removeClass("btn-danger");

                        }else{
                           
                        }
                       }
                    });

                }
            });
        });


</script>
    @endpush
@endsection
