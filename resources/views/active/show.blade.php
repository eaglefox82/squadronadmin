@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <h4 class="card-title text-center">Active Kids Vouchers</h4>
                </div>
                <div class="card-body">
                    <div class="pull-right new-button">
                        <a href="" class="btn btn-primary" title="Add Voucher"><i
                                    class="fa fa-plus fa-2x"></i> Add Voucher</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <th>Date</th>
                            <th class="text-center">Member</th>
                            <th class="text-center">Voucher</th>
                            <th class="text-center">Balance</th>
                            <th width="20%"></th>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>

                                    </td>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
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

@endsection