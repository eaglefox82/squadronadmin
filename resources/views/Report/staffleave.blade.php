@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <h2 class="text-center">Member Leave Overview</h2>
                <div class="card-header card-header-icon card-header-rose">
                  <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addstaffleaveModal" class="btn btn-primary btn-round" title="Add Staff Leave"><i class="fa fa-plus fa-2x"></i> Add Staff Leave</button>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="attendance">
                            <thead class = "text-primary">
                                <tr>
                                    <th class="text-center">Member</th>
                                    <th class="text-center">Leave Date</th>
                                    <th class="text-center">Notice</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingleave as $p)
                                <tr>
                                    <td class="text-center"><strong>{{$p->member->last_name}}, {{$p->member->first_name}}</strong> </td>
                                    <td class="text-center">{{date("jS F Y",strtotime($p->date))}}</td>
                                    <td class="text-center">{{(Carbon\Carbon::parse($p->created_at)->diffForHumans(Carbon\ Carbon::parse($p->date)->addhours(19))) }}</td>
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

<div class="modal fade" id="addstaffleaveModal" tabindex="-1" role="dialog" aria-labelledby="NewStaffLeave" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addstaffleaveModal">New Staff Leave</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(['action' => ['StaffAttendanceController@store'],'method' => 'POST', 'class'=>'form-horizontal'])!!}
            <div class="modal-body">

                <!-- Member -->
                <label class="label-control">Member:</label>
                <div class="input-group">
                    <select type="text" class="selectpicker" data-style="select-with-transition" name="member_id" id="member_id", data-size="6">
                        @foreach($officerlist as $o )
                            <option value="{{$o->id}}">{{$o->last_name}}, {{$o->first_name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Leave Date -->
                <label class="label-control">Leave Date:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="date" id="date" required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Leave</button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>



@endsection
