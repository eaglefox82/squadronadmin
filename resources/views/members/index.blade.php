@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title text-center">Members</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('MembersController@create')}}" class="btn btn-primary" title="Add Member"><i
                                        class="fa fa-plus fa-2x"></i> Add Member</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th></th>
                                <th class="text-center">Membership Number</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Rank</th>
                                </thead>
                                <tbody>
                                    @foreach($members as $m)
                                <tr>
                                    <td class="text-center">
                                    <a href="{{action('MembersController@show', $m->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a>
                                    </td>
                                    <td class="text-center">{{$m->membership_number}}</td>
                                    <td class="text-center">{{$m->last_name}}, {{$m->first_name}}</td>
                                    <td class="text-center">{{$m->memberrank}}</td>
                                </tr>
                                    @endforeach
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


