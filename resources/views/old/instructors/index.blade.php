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
                        <h4 class="card-title ">Instructors</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('InstructorsController@create')}}" class="btn btn-primary" title="Add Instructor"><i
                                        class="fa fa-plus fa-2x"></i> Add Instructor</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th></th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th class="text-center">Grade</th>
                                    <th class="text-center">Flown Hrs</th>
                                    <th class="text-center">Flights</th>
                                </thead>
                                <tbody>
                                    @foreach($instructors as $s)
                                        <tr>
                                            <td><a href="{{action('InstructorsController@show', $s->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a></td>
                                            <td>{{$s->firstName}}</td>
                                            <td>{{$s->lastName}}</td>
                                            <td class="text-center">Grade {{$s->grade}}</td>
                                            <td class="text-center">{{$s->HoursFlown()}}</td>
                                            <td class="text-center">{{$s->Flights->count()}}</td>
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