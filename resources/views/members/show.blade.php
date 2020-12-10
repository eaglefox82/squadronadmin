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
                                <th>Membership Type:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->member_type}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{date("jS F Y",strtotime($member->date_birth))}}</td>
                                <th>Age:</th>
                                <td>{{number_format((float)$member->age,2)}} Years</td>
                                <th>Date of Joining:</th>
                                <td>{{date("jS F Y",strtotime($member->date_joined))}}</td>
                                <th>Service:</td>
                                <td>{{number_format((float)$member->service,2)}} Years</td>
                                <th>Flight:</th>
                                @if($member->flight != 0)
                                <td>{{$member->flightmap->flight_name}}</td>
                                @else
                                <td>No Assigned Flight</td>
                                @endif
                        </table>
                        <div class="pull-right new-button">
                            <a href="" data-toggle="modal" data-target="#addvoucherModal" class="btn btn-primary btn-round" title="Add Voucher"><i class="fa fa-plus fa-2x"></i>&nbsp; Add Voucher</a>
                            <a href="" data-toggle="modal" data-target="#addaccountModal" class="btn btn-info btn-round" title="Add Account"><i class="fa fa-money fa-2x"></i>&nbsp; Add to Account</a>
                            <a href="" data-toggle="modal" data-target="#pointsModal" class="btn btn-primary btn-round" title="Member Points"><i class="fa fa-trophy fa-2x"></i>&nbsp; Member Points</a>
                            <a href="" data-toggle="modal" data-target="#editmemberModal" class="btn btn-success btn-round" title="Edit Member"><i class="fa fa-pencil fa-2x"></i>&nbsp; Edit Member</a>
                            <a href="{{action('MembersController@inactive', $member->id)}}" class="btn btn-danger btn-round" title = "Remove Member"><i class="fa fa-close fa-2x"></i>&nbsp; Remove Member</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class = "card card-stats">
                    <div class ="card-header card-header-info card-header-icon">
                        <div class ="card-icon">
                            <i class="fa fa-trophy fa-2x"></i>
                        </div>
                        <p class="card-category">Points<br><br></p>
                        <h3 class="card-title">{{$member->points->sum('value')}}</h3>
                        <div class = "card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class = "card card-stats">
                    @if ($attendance < $attendancesetting)
                    <div class ="card-header card-header-danger card-header-icon">
                    @else
                    <div class ="card-header card-header-success card-header-icon">
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
                            <p class="card-category">Account Balance<br><br></p>
                            <h3 class="card-title">${{number_format($member->accounts->sum('amount'),2)}}</h3>
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
                             <tr>
                                <td>
                                    <a href="{{action('SquadronAccountingController@show', $r->id)}}" title="View" class="btn btn-success btn-round"><i class="fa fa-info"></i></a>
                                </td>                              </td>
                                <td class = "text-center">{{$r->id}}</td>
                                <td class = "text-center">{{$r->overview}}</td>
                                <td class = "text-center">{{$r->invoice_number}}</td>
                                <td class = "text-center">${{$r->invoice_total}}</td>
                                <td class = "text-center">{{$r->notes}}</td>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif




        <div class="row">

            @if ($member->Accounts->sum('amount') > 0)
            <div class = "col-sm-3">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Account Balance</h4>
                        <a data-toggle="modal" data-target="#accountpayModal" class="btn btn-info btn-round" title="Use Account"><i class="fa fa-money fa-2x"></i>Pay from Account</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class = 'text-primary'>
                                <th class="text-center">Date</th>
                                <th class="text-center">Voucher</th>
                                <th class="text-center">Balance</th>
                            </thead>
                            <tbody>
                            @foreach ($account as $t)
                            <tr>
                                <td class="text-center">{{date("jS F Y", strtotime($t->created_at))}}</td>
                                <td class="text-center">{{$t->Reason}}</td>
                                @if($t->amount > 0)
                                    <td class="text-center">${{$t->amount}}</td>
                                @else
                                    <td class="text-center" style="color:red">${{$t->amount}}</td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $account->links() }}
                </div>
            </div>
            @endif

            @if ($member->outstanding->count() > 0)
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
                                <td class="text-center">{{date("jS F Y", strtotime($o->rollmapping->roll_date))}}</td>
                                <td class="text-center">
                                    <a href="{{action('RollController@updateRollCash', $o->id)}}" title="Cash" class="btn btn-round btn-success"><i class="material-icons">done</i></a>
                                    <a href="{{action('RollController@updateRollAccount', $o->id)}}"  title="Account" class="btn btn-info btn-round"><i class ="fa fa-money fa-2x"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if( $member->Accounts->sum('amount') == 0)
                @if( $member->currentrequests->count() == 0 )
                    @if ($member->outstanding->count() == 0)
                        <h3> No Outstanding Account Balance, Subs or Invoices</h3>
                    @endif
                @endif
            @endif

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
                        <input type="hidden" name="member" value="{{$member->id}}">
                            <label class="label-control">Membership Number:</label>
                            <div class="input-group">
                            <div class="form-group">
                                <input type = "text" class = "form-control" name = "membernumber" value="{{$member->membership_number}}">
                            </div>
                        </div>

                            <label class="label-control">First Name:</label>
                            <div class="input-group">
                                    <div class="form-group">
                                <input type="text" class="form-control" name="firstname" value="{{$member->first_name}}">
                            </div>
                        </div>

                            <label class="label-control">Last Name</label>
                            <div class="input-group">
                                    <div class="form-group">
                                <input type="text" class="form-control" name="lastname" value="{{$member->last_name}}">
                                    </div>
                            </div>

                            <label class="label-control">Rank:</label>
                            <div class="input-group">
                                    <div class="form-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="rank" data-size="6">
                                    @foreach ($rank as $r)
                                    <option value ={{$r->id}} <?php if($member->rank == $r->id) echo 'selected="selected"';?> >{{$r->rank}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                            <label class="label-control">Membership Type</label>
                           <div class="input-group">
                                <div class="form-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="type">
                                    <option value="League"<?php if($member->member_type == "League") echo 'selected="selected"';?>>League Member</option>
                                    <option value="Associate"<?php if($member->member_type == "Associate") echo 'selected="selected"';?>>Associate Member</option>
                                </select>
                           </div>
                    </div>

                    <label class="label-control">Flight:</label>
                    <div class="input-group">
                            <div class="form-group">
                        <select type="text" class="selectpicker" data-style="select-with-transition" name="flight" data-size="6">
                            @foreach ($flight as $f)
                            <option value ={{$f->id}} <?php if($member->flight == $f->id) echo 'selected="selected"';?> >{{$f->flight_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="label-control">Date of Joining:</label>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control datetimepicker" name="doj" value="{{date("j-n-Y", strtotime($member->date_joined))}}">
                    </div>
                </div>

            <label class ="label-control">Date of Birth:</label>
                <div class ="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control datetimepicker" name="dob" value="{{date("j-n-Y", strtotime($member->date_birth))}}">
                    </div>
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

    <div class="modal fade" id="addvoucherModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="addvoucherModal">Add Voucher for {{$member->first_name}} {{$member->last_name}}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!!Form::open(array('action' => ['ActiveKidsController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                    <div class="modal-body">

                            <input type="hidden" name="member" value="{{$member->id}}">

                                <label class="label-control">Voucher Number:</label>
                                <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="voucher">
                                </div>
                                </div>

                                <label class="label-control">Voucher Balance:</label>
                                <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="balance" value="100">
                                </div>
                                </div>

                                <label class="label-control">Voucher Type:</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <select type="text" class="selectpicker" data-sytle="select-with-transition" name="type" value="C">
                                            @foreach ($vtype as $v)
                                                <option value ={{$v->voucher_code}}>{{$v->voucher_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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


        <div class="modal fade" id="addaccountModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="addaccountModal">Add to Balance for {{$member->first_name}} {{$member->last_name}}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!!Form::open(array('action' => ['AccountController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                        <div class="modal-body">

                                <input type="hidden" name="member" value="{{$member->id}}">
                                    <label class="label-control">Amount:</label>
                                    <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="amount">
                                    </div>
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



        <div class="modal fade" id="accountpayModal" tabindex="-1" role="dialog" aria-labelledby="accountpay" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="addaccountModal">Pay from Account of {{$member->first_name}} {{$member->last_name}}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!!Form::open(array('action' => ['AccountController@item'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                        <div class="modal-body">

                                <input type="hidden" name="member" value="{{$member->id}}">
                                <label class="label-control">Item:</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <select type="text" class="selectpicker" data-sytle="select-with-transition" name="item" value="C" id="selectBox">
                                            <option value="">Select item</option>
                                            @foreach ($otheritems as $o)
                                                <option value ={{$o->id}} data-amount="{{$o->amount}}">{{$o->item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <label class="label-control">Amount:</label>
                                    <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="amount" id="textField"></input>
                                    </div>
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


            <div class="modal fade" id="pointsModal" tabindex="-1" role="dialog" aria-labelledby="accountpay" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="addaccountModal">Add to points to {{$member->first_name}} {{$member->last_name}}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!!Form::open(array('action' => ['AccountController@item'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                        <div class="modal-body">

                                <input type="hidden" name="member" value="{{$member->id}}">
                                <label class="label-control">Reason:</label>
                                <div class="input-group">
                                    <div class="form-group">
                                        <select type="text" class="selectpicker" data-sytle="select-with-transition" name="item" value="C" id="selectBox">
                                            <option value="">Select item</option>
                                            @foreach ($otheritems as $o)
                                                <option value ={{$o->id}} data-amount="{{$o->amount}}">{{$o->item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <label class="label-control">Value:</label>
                                    <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="amount" id="valueField"></input>
                                    </div>
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
@endsection


@section ('scripts')

<script>

   $('#selectBox').change(function() {
       let id = $(this).val();
       let url = '{{ route("getPayments", ":id") }}';
       url = url.replace(':id', id);

       $.ajax({
           url: url,
           type: 'get',
           dataType: 'json',
           success: function(response) {
               if (response != null) {
                   $('#textField').val(response.amount);
               }
           }
       });
   });

 </script>

@Stop
