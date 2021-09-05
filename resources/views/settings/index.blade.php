@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class = "row">
            <div class="col-sm-6">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h3 class ="card-title text-center"><strong>Settings</strong></h3>
                        <button data-toggle="modal" data-target="#addsettingModal" type="button" name="Add Setting" class="btn btn-success btn-round pull-right">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class = "card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Setting</th>
                                    <th class="text-center">Value</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $s)
                                        <tr>
                                            <td class="text-center">{{$s->setting}} </td>
                                            <td class="text-center">{{$s->value}} </td>
                                            <td class="td-actions text-right">
                                                <a href="{{action('SettingsController@edit', $s->id)}}" rel="tooltip" class="btn btn-info btn-round">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h3 class ="card-title text-center"><strong>Other Items</strong></h3>
                        <button data-toggle="modal" data-target="#additemModal" type="button" name="Add Item" class="btn btn-success btn-round pull-right">
                             <i class="fa fa-plus"></i>
                    </button>
                    </div>
                    <div class = "card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Remove</th>
                                </thead>
                                <tbody>
                                    @foreach ($otheritems as $o)
                                        <tr>
                                            <td class="text-center">{{$o->item}} </td>
                                            <td class="text-center">${{number_format($o->amount, 2)}}</td>
                                            <td class="text-center">
                                                <a href="{{action('OtheritemsController@inactive', $o->id)}}" title="Mark Inactive" class="btn btn-round btn-danger"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class ="card">
                    <div class ="card-header card-header-icon card-header-rose">
                       <h3 class = "card-title text-center"><Strong>Point Allocation</strong></h3>
                          <button data-toggle="modal" data-target="#addpointsModal" type="button" name="Add User" class="btn btn-success btn-round pull-right">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class = "card-body">
                            <div class = "table-responsive">
                                <table class="table">
                                    <thead class = "text-primary">
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Value</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($points as $p)
                                        <tr>
                                            <td class="text-center">{{$p->Reason}}</td>
                                            <td class="text-center">{{$p->Value}}</td>
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

    <div class = "row">
        <div class = "col-sm-6">
            <div class ="card">
                <div class ="card-header card-header-icon card-header-rose">
                    <h3 class = "card-title text-center"><Strong>Users</strong></h3>
                        <button data-toggle="modal" data-target="#adduserModal" type="button" name="Add User" class="btn btn-success btn-round pull-right">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class = "card-body">
                        <div class = "table-responsive">
                            <table class="table">
                                <thead class = "text-primary">
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Username</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $u)
                                    <tr>
                                        <td class="text-center">{{$u->firstname}}</td>
                                        <td class="text-center">{{$u->lastname}}</td>
                                        <td class="text-center">{{$u->username}}</td>
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


</div>

<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editmemberModal">Add New User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(array('action' => ['UsersController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">
                    <label class="label-control">First Name:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="firstname">
                        </div>

                    <label class="label-control">Last Name:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="lastname">
                        </div>

                     <label class="label-control">Username:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="username">
                        </div> 

                    <label class="label-control">Password:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="password">
                        </div>     

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>


<div class="modal fade" id="addsettingModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editmemberModal">Add Setting</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(array('action' => ['SettingsController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">
                    <label class="label-control">Setting:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="setting">
                        </div>

                        <label class="label-control">Value:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="value">
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>


<div class="modal fade" id="addpointsModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editmemberModal">Add User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(array('action' => ['PointsController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">

                    <label class="label-control">Reason:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="reason">
                        </div>
                    <label class="label-control">Value:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="value">
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>

<div class="modal fade" id="additemModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="additemModal">Add Setting</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['OtheritemsController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                        <label class="label-control">Item:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="item">
                            </div>

                            <label class="label-control">Amount:</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount">
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>

@endsection
