@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class = "row">
        <div class = "col-sm-12">
            <div class = "card">
                <div class = "card-header card-header-icon card-header-rose">
                    <div class="pull-right new-button">
                     <a data-toggle="modal" data-target="#addrequestModal" class="btn btn-success btn-round" title="Add Request"><i class="fa fa-pencil fa-2x"></i>Add Request</a>
                    </div>
                     <h4 class="card-title font-weight-bold">Outstanding Requested Items</h4>
                </div>
                <div class = "card-body">
                    <table class = "table">
                        <thead class = "text-primary text-center">
                            <th width = "5%"></th>
                            <th>Squadron Request No:</th>
                            <th>Name</th>
                            <th width = "10%">Invoice Number</th>
                            <th>Overview</th>
                            <th width = "10%">Total Amount</th>
                            <th width = "10%">Payments</th>
                            <th width = "10%">Balance</th>
                            <th>Notes</th>
                        </thead>
                        @foreach($Srequest as $r)
                        <tbody class = "text-center">
                            <td>
                                <a href="" data-toggle="modal" data-target="#invoicepaymentModal" class = "btn btn-success btn-round" ><i class ="fa fa-dollar"></i></a>
                            </td>
                            <td>{{$r->id}}</td>
                            <td>{{$r->memberrequest->last_name}}, {{$r->memberrequest->first_name}}</td>
                            <td>{{$r->invoice_number}}</td>
                            <td>{{$r->overview}}</td>
                            <td>${{$r->invoice_total}}</td>
                            <td>${{$r->requestpayment->sum('amount')}}</td>
                            <td class = "font-weight-bold">${{$r->invoice_total - $r->requestpayment->sum('amount')}}</td>
                            <td>{{$r->notes}}</td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Dynamic table here -->
    <div class = "row">
    </div>
</div>

<div class="modal fade" id="addrequestModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editmemberModal">Add Request</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(array('action' => ['SquadronAccountingController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">
                <div class="form-group">
                        <label class="label-control">Name:</label>
                        <div class="input-group">
                            <select type="text" class = "selectpicker"  Data-style="select-with-transition" name="membership" data-size="6">
                                @foreach ($members as $m)
                                    <option value ={{$m->id}}>{{$m->last_name}}, {{$m->first_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="label-control">Invoice Number:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="Invoice">
                        </div>

                        <label class="label-control">Overview:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="overview">
                        </div>

                        <label class="label-control">Total Amount:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="total">
                        </div>

                        <label class="label-control">Notes:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="notes">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-round">Save Changes</button>
            </div>
            {{!!Form::close()!!}}
        </div>
    </div>
</div>


<div class="modal fade" id="invoicepaymentModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editmemberModal">Invoice Payment</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <p type="hidden" value=($Srequest as $r)></p>
                </button>
            </div>
            {!!Form::open(array('action' => ['SquadronAccountingController@payment'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">
               <h4>Payment for Request: {{ $r->id}} </h4>
                <div class="form-group">
                        <input type="hidden" name="id" value="{{$r->id}}">
                        <input type="hidden" name="member_id" value="{{$r->member_id}}">
                        <label class="label-control">Payment Amount:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="amount">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-round">Save Changes</button>
            </div>
            {{!!Form::close()!!}}
        </div>
    </div>
</div>


@endsection
