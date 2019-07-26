@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Squadron Accounting</div>
                        <div class="card-body">
                            <p>This page is a dashboard of squadron accounting</p>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
        <div class = "row">

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class = "card card-stats">
                    <div class ="card-header card-header-danger card-header-icon">
                        <div class ="card-icon">
                            <i class="fa fa-book fa-2x"></i>
                        </div>
                         <p class="card-category">Outstanding Subs<br><br></p>
                        <h3 class="card-title">${{($outstanding*10)}}</h3>
                        <div class = "card-footer">
                            <a href={{action('SquadronAccountingController@outstanding')}}>List Members</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class = "card card-stats">
                        <div class ="card-header card-header-info card-header-icon">
                            <div class ="card-icon">
                                <i class="fa fa-id-card-o fa-2x"></i>
                            </div>
                             <p class="card-category">Requests<br><br></p>
                            <h3 class="card-title">${{$requestbalance}}</h3>
                            <div class = "card-footer">
                                <a href={{action('SquadronAccountingController@requested')}}>List Invoices</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col-lg-3 col-md-6 col-sm-6">
                    <div class = "card card-stats">
                        <div class = "card-header card-header-primary card-header-icon">
                            <div class = "card-icon">
                                <i class = "fa fa-dollar fa-2x"></i>
                            </div>
                            <p class="card-category">Other Income<br><br></p>
                            <h3 class ="card-title">$</h3>
                            <div Class = "card-footer">
                                <a href="">Receive other money</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class ="row">

                <div class = "col-lg-3 col-md-6 col-sm-6">
                        <div class = "card card-stats">
                            <div class = "card-header card-header-success card-header-icon">
                                <div class = "card-icon">
                                    <i class = "fa fa-money fa-2x"></i>
                                </div>
                                <p class="card-category">Total Subs<br><br></p>
                                <h3 class ="card-title">${{$totalsubs}}</h3>
                                <div Class = "card-footer">
                                    <a href="">Including Past Subs Paid</a>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


       <!-- <div Class = "row">
            <div class="col-sm-8">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Receipt of Squadron Receipts</h4>
                    </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th class="text-center">Subs Collected</th>
                                    <td class = "text-center">$subs</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Vouchers for Subs</th>
                                    <td class="text-center">$voucherpayment</th>
                                </tr>
                                <tr>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
        </div> -->



</div>
@endsection
