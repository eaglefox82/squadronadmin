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
                                    <th class="text-center">Member</th>
                                    <th class="text-center">Rank</th>
                                    <th class="text-center">Present</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"> </td>
                                    <td class="text-center"> </td>
                                    <td class="text-center"></td>
                                <!-- <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-round">
                                            <i class="Material-icons">edit</i>
                                        </button>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection