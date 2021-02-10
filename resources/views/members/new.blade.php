@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose pull-center">
                        <h2 class="card-title text-center">New Members</h2>
                    </div>
                    <div class="card-body">
                        <div class = "pull-left">
                            <form cclass="navbar-form">
                                <span class="bmd-form-group">
                                    <div class="input-group no-border">
                                        <button class = "btn btn-white btn-round btn-just-icon fa fa-search"></button>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Member Here" autofocus/>
                                    </div>
                                </span>
                            </form>
                        </div>
                        <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addmemberModal" class="btn btn-primary btn-round" title="Add Member"><i class="fa fa-plus fa-2x"></i> Add Member</button>
                    </div>

                        <div class="table-responsive">
                            <table class="table" id="membertable">
                                <thead class="text-primary">
                                <th ></th>
                                <th width = "15%" class="text-center">Membership Number</th>
                                <th width = "30%" class="text-center">Name</th>
                                <th width = "20%" class="text-center">Rank</th>
                                <th Class="text-center">Flight</th>
                                <th width = "20%" class="text-center">Account Balance</th>
                                <th class="text-center">Days to Birthday</th>
                                </thead>
                                <tbody>
                                        @foreach($newmembers as $m)
                                      <tr>
                                          <td class="text-center">
                                            <a href="{{action('MembersController@show', $m->id)}}" target="_blank" title="View" class="btn btn-round btn-success"><i class="fa fa-info"></i></a>
                                          </td>
                                          @if ($m->membership_number != "New")
                                              <td class="text-center">{{$m->membership_number}}</td>
                                          @else
                                              <td class="text-center" style="color:red"><strong>{{$m->membership_number}}</td>
                                          @endif

                                          <td class="text-center">{{$m->last_name}}, {{$m->first_name}}</td>
                                          <td class="text-center">{{$m->memberrank->rank}}</td>
                                          @if($m->flight != 0)
                                            <td clas="text-center">{{$m->flightmap->flight_name}}</td>
                                        @else
                                             <td></td>
                                        @endif
                                          @if ($m->Accounts->sum('amount') != 0)
                                              <td class="text-center"><strong>${{number_format($m->Accounts->sum('amount'),2)}}</td>
                                          @else
                                              <td style="border-top: 1px #ddd solid"></td>
                                          @endif
                                                <td class="text-center">{{$m->birthday}}</td>
                                          @endforeach
                                        </tr>
                                      </tbody>
                                      <tfooter>
                                          <tr>
                                          </tr>
                                      </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section ('scripts')
<script>
    // Write on keyup event of keyword input element
    $(document).ready(function(){
      $("#search").keyup(function(){
      _this = this;

      // Show only matching TR, hide rest of them
      $.each($("#membertable tbody tr"), function() {
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
        {
            $(this).hide();
        }
        else
        {
           $(this).show();
        }
      });
   });
 });
 </script>


     <script type="text/javascript">
            $(function () {
                $('.datetimepicker').datetimepicker({
                    icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove',
            container: "#addmemberModal",
            }
                });
            });
        </script>

@stop

