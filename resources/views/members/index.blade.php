@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose pull-center">
                        <h2 class="card-title text-center">Members</h2>
                    </div>
                    <div class="card-body">
                        <div class = "pull-left">
                            <form cclass="navbar-form">
                                <span class="bmd-form-group">
                                    <div class="input-group no-border">
                                        <button class = "btn btn-white btn-round btn-just-icon fa fa-search"></button>
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search member Here"/>
                                    </div>
                                </span>
                            </form>
                        </div>
                        <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#newmemberModal"><i
                                        class="fa fa-plus fa-2x"></i> Add Member</a></button>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="members_table">
                                <thead class="text-primary">
                                <th ></th>
                                <th width = "25%" class="text-center">Membership Number</th>
                                <th width = "40%" class="text-center">Name</th>
                                <th width = "25%" class="text-center">Rank</th>
                                <th width = "20%" class="text-center">Voucher Balance</th>
                                </thead>
                                <tbody>
                                        @foreach($members as $m)
                                      <tr>
                                          <td class="text-center">
                                          <a href="{{action('MembersController@show', $m->id)}}" title="View" class="btn btn-round btn-success"><i class="fa fa-info"></i></a>
                                          </td>
                                          @if ($m->membership_number != "New")
                                              <td class="text-center">{{$m->membership_number}}</td>
                                          @else
                                              <td class="text-center" style="color:red"><strong>{{$m->membership_number}}</td>
                                          @endif

                                          <td class="text-center">{{$m->last_name}}, {{$m->first_name}}</td>
                                          <td class="text-center">{{$m->memberrank->rank}}</td>
                                          @if ($m->ActiveKids->sum('balance') != 0)
                                              <td class="text-center"><strong>${{number_format($m->ActiveKids->sum('balance'),2)}}</td>
                                          @else
                                              <td style="border-top: 1px #ddd solid"></td>
                                          @endif
                                      </tr>
                                          @endforeach
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

    <div class="modal fade" id="newmemberModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">New Roll</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                {!!Form::open(array('action' => ['MembersController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                        <div class="form-group">
                            <label class="label-control">MemberShip Number:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="membership" value="New">
                                </div>

                            <label class="label-control">First Name:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="firstname">
                                </div>

                            <label class="label-control">Last Name:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="lastname">
                                </div>

                            <label class="label-control">Rank:</label>
                                <div class="input-group">
                                    <select type="text" class = "selectpicker"  Data-style="select-with-transition" name="rank" data-size="6">
                                        @foreach ($rank as $r)
                                            <option value ={{$r->id}}>{{$r->rank}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <label class="label-control">Date of Birth:</label>
                                <div class="input-group">
                                    <input type = "text" class = "form-control datetimepicker" name="dob" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                </div>

                            <label class="label-control">Date of Joining</label>
                                <div class="input-group">
                                    <input type = "text" class = "form-control datetimepicker" name="doj" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                </div>

                        </div> <!-- form group div close -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-round btn-primary">Create Member</button>
                </div>
                {!!Form::close()!!}
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
          $.each($("#roll tbody tr"), function() {
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

       $.ajax({
            type:"get",
            url:"{{ url('/getmembers') }}",
            success: function(result){

                }
        });
     });
     </script>


@stop

