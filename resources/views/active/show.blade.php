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
                            <th class="text-center">Membership Number</th>
                            <th class="text-center">D.O.B</th>
                            <th class="text-center">Voucher</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Banking Reference</th>
                            <th width="20%"></th>
                            </thead>
                            <tbody>
                            @foreach($vouchers as $v)
                                <tr>
                                    <td class="text-center">{{date('j/n/Y', strtotime($v->created_at))}}</td>
                                    <td class="text-center">{{$v->member->first_name}} {{$v->member->last_name}}</td>
                                    <td class="text-center">{{$v->member->membership_number}}</td>
                                    <td class="text-center">{{date("jS F Y",strtotime($v->member->date_birth))}}</td>
                                    <td class="text-center">{{$v->voucher_number}}</td>
                                    <td class="text-center">{{$v->type->voucher_type}}</td>
                                    <td class="text-center">{{$v->vstatus->desc}}</td>
                                    <td class="text-center">{{$v->banking_reference}}</td>
                                    @if($v->status != "S")
                                        <td class="text-center">
                                            <a href="{{action('ActiveKidsController@submit', $v->id)}}" class="btn btn-round btn-success" title="Sumbit Voucher">Submitted</a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <a href="{{action('ActiveKidsController@edit', $v->id)}}" class="btn btn-round btn-rose" title="Banking Reference"">Banking Reference</a>
                                            <a href="{{action('ActiveKidsController@complete', $v->id)}}" class="btn btn-round btn-success" title="Complete Voucher">Completed</a>
                                        </td>
                                    @endif
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

