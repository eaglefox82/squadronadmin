@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Instructor Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>First Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$instructor->firstName}}</td>
                                <th>Last Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$instructor->lastName}}</td>
                            </tr>
                            <tr>
                                <th>Grade:</th>
                                <td>{{$instructor->grade}}</td>
                                <td colspan="2"></td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <h3>Flights</h3>
                            <table class="table">
                                <thead class="text-primary">
                                    <th></th>
                                    <th>Date</th>
                                    <th class="text-center">FAS</th>
                                    <th class="text-center">Aircraft</th>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Lesson</th>
                                    <th class="text-center">Hours</th>
                                    <th class="text-center">Landings</th>
                                    <th class="text-center">Flight Total</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                @php
                                    $hrs = 0;
                                    $landings = 0;
                                    $income = 0;
                                @endphp
                                @foreach ($instructor->Flights as $f)
                                    @php
                                        $hrs += $f->hours;
                                        $landings += $f->landings;
                                        $income += $f->flightTotal;
                                    @endphp
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{action('FlightsController@show', $f->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a>
                                        </td>
                                        <td>{{date('j/n/Y', strtotime($f->flightDate))}}</td>
                                        <td class="text-center">{{$f->fas}}</td>
                                        <td class="text-center"><a href="{{action('AircraftsController@show', $f->Aircraft->id)}}" >{{$f->Aircraft->registration}} ({{$f->Aircraft->type}})</a></td>
                                        <td class="text-center">
                                            <a href="{{action('StudentsController@show', $f->student->id)}}" >{{$f->student->firstName}} {{$f->student->lastName}}</a>
                                        </td>
                                        <td class="text-center">{{$f->lesson}}</td>
                                        <td class="text-center">{{$f->hours}}</td>
                                        <td class="text-center">{{$f->landings}}</td>
                                        <td class="text-center">${{number_format($f->flightTotal, 2)}}</td>
                                        <td>
                                            <a href="{{action('FlightsController@edit', $f->id)}}" class="btn btn-info" title="Edit Flight"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tfooter>
                                    <tr style="font-weight: bold">
                                        <td class="text-right" colspan="6">Totals:</td>
                                        <td class="text-center">{{number_format((float)$hrs, 1)}}</td>
                                        <td class="text-center">{{$landings}}</td>
                                        <td class="text-center">${{number_format($income, 2)}}</td>
                                        <td></td>
                                    </tr>
                                </tfooter>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection