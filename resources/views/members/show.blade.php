@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if(session()->has('success'))
            <div class="row">
                <div class="col-12 alert alert-success" role="alert">
                    <strong>{{session()->get('success')}}</strong>
                </div>
            </div>
        @endif
        @if(session()->has('failure'))
            <div class="row">
                <div class="col-12 alert alert-danger" role="alert">
                    <strong>{{session()->get('failure')}}</strong>
                </div>
            </div>
        @endif

        @if(session()->has('done'))
            <div class="row">
                <div class="col-12 alert alert-warning" role="alert">
                    <strong>{{session()->get('done')}}</strong>
                </div>
            </div>
        @endif

        <div class="row">
            <div class = "col-sm-12">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                            <div class="pull-right new-button">
                                <a href="" data-toggle="modal" data-target="#editmemberModal" class="btn btn-success" title="Edit Member"><i class="fa fa-pencil fa-2x"></i> Edit Member</a>
                                <a href="{{action('MembersController@inactive', $member->id)}}" class="btn btn-danger" title = "Remove Member"><i class="fa fa-close fa-2x"></i>Remove Member</a>
                             </div>
                        <h4 class="card-title font-weight-bold">Member Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>First Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->first_name}}</td>
                                <th>Last Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->last_name}}</td>
                                <th>Rank:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->memberrank->rank}}</td>
                                <th>Membership:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->membership_number}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{date("jS F Y",strtotime($member->date_birth))}}</td>
                                <th>Age:</th>
                                <td>{{$member->age}} years</td>
                                <th>Date of Joining:</th>
                                <td>{{date("jS F Y",strtotime($member->date_joined))}}</td>
                                <th>Service:</td>
                                <td>{{number_format((float)$member->service)}} years</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class = "card card-stats">
                    <div class ="card-header card-header-info card-header-icon">
                        <div class ="card-icon">
                            <i class="fa fa-handshake-o fa-2x"></i>
                        </div>
                        <p class="card-category">Membership Type<br><br></p>
                        <h3 class="card-title">{{$member->member_type}}</h3>
                        <div class = "card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class = "card card-stats">
                    @if ($attendance > $attendancesetting)
                    <div class ="card-header card-header-success card-header-icon">
                    @else
                    <div class ="card-header card-header-danger card-header-icon">
                    @endif
                        <div class ="card-icon">
                            <i class="fa fa-book fa-2x"></i>
                        </div>
                        <p class="card-category">Attendance Rate<br><br></p>
                        <h3 class="card-title">{{number_format($attendance,2)}}%</h3>
                        <div class = "card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-ticket fa-2x"></i>
                            </div>
                            <p class="card-category">Voucher Balance<br><br></p>
                            <h3 class="card-title">${{number_format($member->ActiveKids->sum('balance'),2)}}</h3>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        @if ($member->outstanding->where('status','P')->count() != 0)
                        <div class="card-header card-header-danger card-header-icon">
                        @else
                        <div class="card-header card-header-success card-header-icon">
                        @endif
                            <div class="card-icon">
                                <i class="fa fa-usd fa-2x"></i>
                            </div>
                            <p class="card-category">Total Subs Owning<br><br></p>
                            <h3 class="card-title">${{($member->outstanding->where('status','P')->count())*10}}</h3>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- This is to only show the table if there is data to show -->
        @if ($member->currentrequests->count() > 0)
        <div class="row">
            <div class="col-sm-12">
                <div class ="card">
                    <div class = "card-header card-header-icon card-header-rose">
                        <h4 class = "text-center">Requested Items</h4>
                    </div>
                    <div class = "table-responsive">
                        <table class = "table">
                            <thead class = "text-primary">
                                <th width = "10%"></th>
                                <th class = "text-center">Request Number</th>
                                <th class = "text-center">Overview</th>
                                <th class = "text-center">Invoice Number</th>
                                <th class = "text-center">Invoice Total</th>
                                <th width = "25%" class = "text-center">Notes</th>
                            </thead>
                            <tbody>
                             @foreach ($member->currentrequests as $r)
                                <td>
                                    <a href="{{action('MembersController@show', $r->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a>
                                </td>                              </td>
                                <td class = "text-center">{{$r->id}}</td>
                                <td class = "text-center">{{$r->overview}}</td>
                                <td class = "text-center">{{$r->invoice_number}}</td>
                                <td class = "text-center">${{$r->invoice_total}}</td>
                                <td class = "text-center">{{$r->notes}}</td>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif




        <div class="row">
            <div class = "col-sm-9">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                            <div class="pull-right new-button">
                                <a data-toggle="modal" data-target="#addvoucherModal" class="btn btn-primary" title="Add Voucher"><i class="fa fa-plus fa-2x"></i> Add Voucher</a>
                             </div>
                             <h4 class="card-title font-weight-bold">Active Kids Vouchers</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class = 'text-primary'>
                                <th class="text-center">Date</th>
                                <th class="text-center">Voucher</th>
                                <th class="text-center">Balance</th>
                            </thead>
                            <tbody>
                            @foreach ($member->Activekids as $t)
                            <tr>
                                <td class="text-center">{{date('j/n/Y', strtotime($t->date_received))}}</td>
                                <td class="text-center">{{$t->voucher_number}}</td>
                                <td class="text-center">${{$t->balance}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class = "col-lg-3 col-md-6 col-sm-6">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Subs Owning</h4>
                            <div class="pull-right new-button">
                             </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class = 'text-primary'>
                                <th class="text-center">Date</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @foreach ($member->outstanding as $o)
                            <tr>
                                <td class="text-center">{{date('j/n/Y', strtotime($o->rollmapping->roll_date))}}</td>
                                <td class="text-center"><a href="{{action('RollController@updateRoll', $o->id)}}" title="Paid" class="btn btn-success"><i class="material-icons">done</i></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editmemberModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="editmemberModal">Edit Member</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(array('action' => ['MembersController@update', $member->id],'method'=>'PUT', 'class'=>'form-horizontal')) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="member" value="{{$member->id}}">
                            <label class="label-control">Membership Number:</label>
                            <div class="input-group">
                                <input type = "text" class = "form-control" name = "membernumber" value="{{$member->membership_number}}">
                            </div>

                            <label class="label-control">First Name:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="firstname" value="{{$member->first_name}}">
                            </div>

                            <label class="label-control">Last Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="lastname" value="{{$member->last_name}}">
                            </div>

                            <label class="label-control">Rank:</label>
                            <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="rank" data-size="6">
                                    @foreach ($rank as $r)
                                    <option value ={{$r->id}} <?php if($member->rank == $r->id) echo 'selected="selected"';?> >{{$r->rank}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="label-control">Membership Type</label>
                           <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="type">
                                    <option value="League"<?php if($member->member_type == "League") echo 'selected="selected"';?>>League Member</option>
                                    <option value="Associate"<?php if($member->member_type == "Associate") echo 'selected="selected"';?>>Associate Member</option>
                                </select>
                           </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                {{!!Form::close()!!}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addvoucherModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="editmemberModal">Add Voucher</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!!Form::open(array('action' => ['ActiveKidsController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="member" value="{{$member->id}}">
                                <label class="label-control">Date:</label>
                                <div class="input-group">
                                        <input type="text" class="form-control datetimepicker" name="rolldate" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                </div>

                                <label class="label-control">Voucher:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="voucher">
                                </div>

                                <label class="label-control">Voucher Balance:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="balance">
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    {{!!Form::close()!!}}
                </div>
            </div>
        </div>
@endsection
