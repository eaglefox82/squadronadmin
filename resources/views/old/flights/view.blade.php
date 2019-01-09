@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title ">Flight Details</h4>
                    </div>

                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('FlightsController@edit', $flight->id)}}" class="btn btn-info" title="Edit Flight"><i class="fa fa-pencil"></i> Edit Flight</a>
                        </div>

                        <table class="table">
                            <tr>
                                <th width="20%">Fas #:</th>
                                <td style="border-top: 1px #ddd solid">{{$flight->fas}}</td>
                            </tr>
                            <tr>
                                <th>Date:</th>
                                <td>
                                    {{date('j/n/Y', strtotime($flight->flightDate))}}
                                </td>
                            </tr>
                            <tr>
                                <th>Student:</th>
                                <td><a href="{{action('StudentsController@show', $flight->student->id)}}" >{{$flight->student->firstName}} {{$flight->student->lastName}}</a></td>
                            </tr>
                            <tr>
                                <th>Instructor:</th>
                                <td>
                                    @if ($flight->instructorID == 0)
                                        Student Solo
                                    @else
                                        <a href="{{action('InstructorsController@show', $flight->instructor->id)}}" >{{$flight->instructor->firstName}} {{$flight->instructor->lastName}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Aircraft:</th>
                                <td><a href="{{action('AircraftsController@show', $flight->aircraft->id)}}" >{{$flight->aircraft->registration}} ({{$flight->aircraft->type}})</a></td>
                            </tr>
                            <tr>
                                <th>Hours:</th>
                                <td>{{$flight->hours}} hours</td>
                            </tr>
                            <tr>
                                <th>Landings:</th>
                                <td>{{$flight->landings}}</td>
                            </tr>
                            <tr>
                                <th>Full Stop Landings:</th>
                                <td>{{$flight->fullstopLandings}}</td>
                            </tr>
                            <tr>
                                <th>Flight Total:</th>
                                <td>${{$flight->flightTotal}}</td>
                            </tr>
                            <tr>
                                <th>Paid:</th>
                                <td>
                                    @if ($flight->paid == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Lesson:</th>
                                <td>{{$flight->lesson}}</td>
                            </tr>
                            <tr>
                                <th>Notes:</th>
                                <td>{{$flight->notes}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection