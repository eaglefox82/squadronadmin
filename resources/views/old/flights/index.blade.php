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
                        <h4 class="card-title ">Flights</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('FlightsController@create')}}" class="btn btn-primary" title="Add Flight"><i
                                        class="fa fa-plus fa-2x"></i> Add Flight</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th></th>
                                    <th>Date</th>
                                    <th class="text-center">FAS</th>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Aircraft</th>
                                    <th class="text-center">Instructor</th>
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
                                    @foreach($flights as $s)
                                        @php
                                            $hrs += $s->hours;
                                            $landings += $s->landings;
                                            $income += $s->flightTotal;
                                        @endphp

                                        <tr>
                                            <td><a href="{{action('FlightsController@show', $s->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a></td>
                                            <td>{{date('j/n/Y', strtotime($s->flightDate))}}</td>
                                            <td class="text-center">{{$s->fas}}</td>
                                            <td class="text-center">{{$s->Student->firstName}} {{$s->Student->lastName}}</td>
                                            <td class="text-center">{{$s->Aircraft->registration}} ({{$s->Aircraft->type}})</td>
                                            <td class="text-center">
                                                @if ($s->Instructor != null)
                                                    {{$s->Instructor->firstName}} {{$s->Instructor->lastName}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{$s->hours}}</td>
                                            <td class="text-center">{{$s->landings}}</td>
                                            <td class="text-center">${{number_format($s->flightTotal, 2)}}</td>
                                            <td>
                                                EDIT BTN
                                            </td>
                                        </tr>
                                    @endforeach
                                <tfooter>
                                    <tr style="font-weight: bold">
                                        <td class="text-right" colspan="6">Totals:</td>
                                        <td class="text-center">{{$hrs}}</td>
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