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
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <th class="text-center">Date</th>
                            <th class="text-center">Member</th>
                            <th class="text-center">Voucher</th>
                            <th class="text-center">Balance</th>
                            <th width="20%"></th>
                            </thead>
                            <tbody>
                            @foreach($vouchers as $key => $v)
                                <tr>
                                    <td class="text-center">{{date('j/n/Y', strtotime($v->date_received))}}</td>
                                    <td class="text-center">{{$v->first_name}} {{$v->last_name}}</td>
                                    <td class="text-center">{{$v->voucher_number}}</td>
                                    <td class="text-center">${{$v->balance}}</td>
                                    <td class="text-center">
                                        <a href="{{action('ActiveKidsController@complete', $v->id)}}" class="btn btn-success" title="Complete Voucher"><i class="fa fa-check"></i></a>
                                    </td>
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

@endsection