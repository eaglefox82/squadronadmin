@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class = "row">
        <div class = "col-sm-12">
            <div class = "card">
                <div class = "card-header card-header-icon card-header-rose">
                    <div class="pull-right new-button">
                     <a href = "" class="btn btn-success" title="Add Request"><i class="fa fa-pencil fa-2x"></i>Add Request</a>
                    </div>
                     <h4 class="card-title font-weight-bold">Outstanding Requested Items</h4>
                </div>
                <div class = "card-body">
                    <table class = "table">
                        <thead class = "text-primary text-center">
                            <th width = "16%"></th>
                            <th>Name</th>
                            <th width = "10%">Invoice Number</th>
                            <th>Overview</th>
                            <th width = "10%">Total Amount</th>
                            <th width = "10%">Payments</th>
                            <th width = "10%">Balance</th>
                            <th>Notes</th>
                        </thead>
                        @foreach($request as $r)
                        <tbody class = "text-center">
                            <td>
                                <a href="" class = "btn btn-info"><i class="fa fa-info"></i></a>
                                <a href="" class = "btn btn-primary"><i class="fa fa-cog"></i></a>
                                <a href="" class = "btn btn-success"><i class ="fa fa-dollar"></i></a>
                            </td> 
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


@endsection