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
                        <h4 class="card-title ">Aircraft</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('AircraftsController@create')}}" class="btn btn-primary" title="Add Aircraft"><i
                                        class="fa fa-plus fa-2x"></i> Add Aircraft</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th></th>
                                    <th>Registration</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Flown Hrs</th>
                                    <th class="text-center">Flights</th>
                                    <th class="text-center">Landings</th>
                                    <th class="text-center">Total Income</th>
                                </thead>
                                <tbody>
                                    @php
                                        $hrs = 0;
                                        $flights = 0;
                                        $landings = 0;
                                        $income = 0;
                                    @endphp
                                    @foreach($aircraft as $s)
                                        @php
                                            $hrs += $s->HoursFlown();
                                            $flights += $s->Flights->count();
                                            $landings += $s->Flights->sum('landings');
                                            $income += $s->Flights->sum('flightTotal');
                                        @endphp

                                        <tr>
                                            <td><a href="{{action('AircraftsController@show', $s->id)}}" title="View" class="btn btn-success"><i class="fa fa-info"></i></a></td>
                                            <td>{{$s->registration}}</td>
                                            <td class="text-center">{{$s->type}}</td>
                                            <td class="text-center">{{$s->HoursFlown()}}</td>
                                            <td class="text-center">{{$s->Flights->count()}}</td>
                                            <td class="text-center">{{$s->Flights->sum('landings')}}</td>
                                            <td class="text-center">${{number_format($s->Flights->sum('flightTotal'), 2)}}</td>
                                        </tr>
                                    @endforeach
                                <tfooter>
                                    <tr style="font-weight: bold">
                                        <td class="text-right" colspan="3">Totals:</td>
                                        <td class="text-center">{{$hrs}}</td>
                                        <td class="text-center">{{$flights}}</td>
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