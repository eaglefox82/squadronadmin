@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                        <div class="pull-right new-button">
                                <a data-toggle="modal" data-target="#invoicepaymentModal" class ="btn btn-primary btn-round" title="Invoice Payment"><i class="fa fa-dollar fa-2x"></i>Invoice Payment</a>
                               </div>
                    <h4 class="card-title text-center">Invoice Overview</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <th class="text-center" width = "10%">Group Invoice Number</th>
                            <th class="text-center" width = "15%">Name</th>
                            <th class="text-center" width = "10%">Overview</th>
                            <th class="text-center" width = "10%">Total Amount</th>
                            <th class="text-center" width = "10%">Payments</th>
                            <th class="text-center" width = "10%">Balance</th>
                            <th class="text-center">Notes</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{$request->invoice_number}}</td>
                                    <td class="text-center">{{$request->memberrequest->last_name}}, {{$request->memberrequest->first_name}}</td>
                                    <td class="text-center">{{$request->overview}}</td>
                                    <td class="text-center">${{$request->invoice_total}}</td>
                                    <td class="text-center">${{$request->requestpayment->sum('amount')}}</td>
                                    <td class="text-center">${{$request->invoice_total-$request->requestpayment->sum('amount')}}</td>
                                    <td class="text-center">{{$request->notes}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <h4 class="card-title text-center">Payment History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <th class="text-center" width = "10%">Date</th>
                            <th class="text-center" width = "15%">Amount</th>
                            </thead>
                            <tbody>
                                @foreach($payments as $p)
                                <tr>
                                    <td class="text-center">{{date("jS F Y",strtotime($p->date->roll_date))}}</td>
                                    <td class="text-center">${{$p->amount}}</td>
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



<div class="modal fade" id="invoicepaymentModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editmemberModal">Invoice Payment</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['SquadronAccountingController@payment'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                   <h4>Payment for Request</h4>
                    <div class="form-group">
                        <label class="label-control">Invoice Number:</label>
                        <div class="input-group">
                               <input type ="text" class="form-control" name="id" placeholder = {{$request->id}}>
                        </div>
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
                {!!Form::close()!!}
            </div>
        </div>
    </div>

@endsection
