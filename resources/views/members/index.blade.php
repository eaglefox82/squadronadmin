@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Members On Roll<br><br></p>
                        <h3 class="card-title">{{$members->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-male fa-2x"></i>
                        </div>
                        <p class="card-category">Male Members<br>{{number_format(($malemembers->count()/($members->count()))*100,2)}}%<br></p>
                        <h3 class="card-title">{{$malemembers->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-female fa-2x"></i>
                        </div>
                        <p class="card-category">Female Members<br>{{number_format(($femalemembers->count()/($members->count()))*100,2)}}%<br></p>
                        <h3 class="card-title">{{$femalemembers->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-phone fa-2x"></i>
                        </div>
                        <p class="card-category">Members requiring follow up</br></br></p>
                        <h3 class="card-title">{{$members->where('attendancewarning',"<", 2)->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose pull-center">
                        <h2 class="card-title text-center">Members</h2>
                    </div>
                    <div class="card-body">
                        <div class = "pull-left">
                            <form class="navbar-form">
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
                                        @foreach($members as $m)

                                        @if($m->attendancewarning == 3)
                                            <tr bgcolor="#FED3D4">
                                        @else
                                            <tr>
                                        @endif
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
</div>

    <div class="modal fade" id="addmemberModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="addmemberModal">Add Member</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['MembersController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                            <label class="label-control">Membership Number:</label>
                            <div class="input-group">
                                <input type = "text" class = "form-control" name = "membership" value="">
                            </div>

                            <label class="label-control">First Name:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="firstname" value="">
                            </div>

                            <label class="label-control">Last Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="lastname" value="">
                            </div>

                            <label class="label-control">Rank:</label>
                            <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="rank" data-size="6">
                                    @foreach ($rank as $r)
                                    <option value ={{$r->id}} >{{$r->rank}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <label class="label-control">Date of Joining:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="doj" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                    </div>
                                </div>

                            <label class ="label-control">Date of Birth:</label>
                                <div class ="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="dob" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                    </div>
                                </div>

                            <label class="label-control">Membership Type</label>
                           <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="type">
                                    <option value="League">League Member</option>
                                    <option value="Associate">Associate Member</option>
                                </select>
                           </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-round btn-primary">Save Changes</button>
                </div>
                {!!Form::close()!!}
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

