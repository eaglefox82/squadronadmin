@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <h4 class="card-title">Roll Date:</h4>
                    <div class="pull-right new-button">
                        <a href="{{action('RollController@create')}}" class="btn btn-primary" title="Add Voucher"><i class="fa fa-plus fa-2x"></i>Create New Roll</a>
                    </div>
                </div>
                <div class="card-body">
    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="20%"></th>    
                                    <th class="text-center">Member</th>
                                    <th width = "20%" class="text-center">Rank</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-cetner">Voucher Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($currentroll as $r)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{action('RollController@paid', $r->id)}}" title="Paid" class="btn btn-success"><i class="material-icons">done</i></a>
                                        <a href="{{action('RollController@voucher', $r->id)}}"  title="Voucher" class="btn btn-info"><i class ="material-icons">local_activity</i></a>
                                        <a href="{{action('RollController@notpaid', $r->id)}}" title="Paid" class="btn btn-danger"><i class="material-icons">close</i></a>
                                    </td>
                                    <td class="text-center">{{$r->last_name}}, {{$r->first_name}} </td>
                                    <td class="text-center">{{$r->rank}}</td>
                                    <td class="text-center">{{$r->status}}</td>
                                    <td class="text-center"></td>
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