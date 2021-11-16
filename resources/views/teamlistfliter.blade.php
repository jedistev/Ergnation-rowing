@extends('layouts.main')
@section('title', 'List of Team with Athetlic')
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
                            <h5>{{ __('Team')}}</h5>
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
                                <a href="#">List of Team with Athetlic</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Table</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php
        /*echo "<pre>";
        print_r($teamlistfliter);
        echo "</pre>";*/
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        <h3>{{ __('Team')}}</h3>
                        <div class="Team-filter">
                        <select id="TeamFilter" class="form-control">
                                <option value="">Show All</option>
                                @foreach($teamnames as $row)
                                <?php 
                                    $teamdata  = App\Team::find($row->team);
                                ?>
                                    <option>{{ @$teamdata->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="filterTable"
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
                                    @foreach($teamlistfliter as $row)
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
    <script>
    $("document").ready(function () {
      $("#filterTable").dataTable({
        "searching": true
      });
      var table = $('#filterTable').DataTable();
      $("#filterTable_filter.dataTables_filter").append($("#TeamFilter"));
      var TeamIndex = 0;
      $("#filterTable th").each(function (i) {
        if ($($(this)).html() == "Team") {
          TeamIndex = i; return false;
        }
      });
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selectedItem = $('#TeamFilter').val()
          var Team = data[TeamIndex];
          if (selectedItem === "" || Team.includes(selectedItem)) {
            return true;
          }
          return false;
        }
      );
      $("#TeamFilter").change(function (e) {
        table.draw();
      });
      table.draw();
    });
  </script>
    @endpush
@endsection