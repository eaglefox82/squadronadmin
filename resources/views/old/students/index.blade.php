@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="row">
                <div class="alert alert-success" role="alert">
                    <strong>{{session()->get('success')}}</strong>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title ">Students - In Camp: {{$students->where('campForm', 1)->count()}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('StudentsController@create')}}" class="btn btn-primary" title="Add Student"><i
                                        class="fa fa-plus fa-2x"></i> Add Student</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th></th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th class="text-center">Squadron</th>
                                    <th class="text-center">Age</th>
                                    <th class="text-center">Requested Hrs</th>
                                    <th class="text-center">Flown Hrs</th>
                                    <th class="text-center">Hrs Remaining</th>
                                    <th class="text-center">Flights</th>
                                    <th class="text-center">Account Total</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($students as $s)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{action('StudentsController@show', $s->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a>
                                            </td>
                                            <td>{{$s->firstName}}</td>
                                            <td>{{$s->lastName}}</td>
                                            <td class="text-center">{{$s->squadron}}</td>
                                            <td class="text-center">{{$s->age}}</td>
                                            <td class="text-center">{{$s->hoursRequested}}</td>
                                            <td class="text-center">{{$s->HoursFlown()}}</td>
                                            <td class="text-center">{{$s->hoursRequested - $s->HoursFlown()}}</td>
                                            <td class="text-center">{{$s->Flights->count()}}</td>
                                            <td class="text-center">${{number_format($s->AccountTotal(),2)}}</td>
                                            <td>
                                                @if ($s->campForm == 0)
                                                    <a href="{{action('StudentsController@checkIn', $s->id)}}" title="Check In" class="btn btn-primary"><i class="fa fa-folder-open"></i></a>
                                                @endif
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