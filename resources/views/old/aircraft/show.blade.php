@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title ">
                            @if ($aircraft->type == "PA28")
                                Piper Warrior {{$aircraft->registration}}
                            @else
                                Cessna 152 {{$aircraft->registration}}
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Registration:</th>
                                <td style="border-top: 1px #ddd solid">{{$aircraft->registration}}</td>
                                <th>Type:</th>
                                <td style="border-top: 1px #ddd solid">{{$aircraft->type}}</td>
                            </tr>
                            <tr>
                                <th>Rate:</th>
                                <td>${{$aircraft->rate}}</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <th>Hours Flown:</th>
                                <td>
                                    <h4>{{$aircraft->HoursFlown()}}</h4>
                                </td>
                                <th>Flights Completed:</th>
                                <td>
                                    <h4>{{$aircraft->Flights->count()}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Landings:</th>
                                <td>
                                    <h4>{{$aircraft->Flights->sum('landings')}}</h4>
                                </td>
                                <th>Flights Income:</th>
                                <td>
                                    <h4>${{number_format($aircraft->Flights->sum('flightTotal'), 2)}}</h4>
                                </td>
                            </tr>
                        </table>

                        <div class="table-responsive">
                            <h3>Flights</h3>
                            <table class="table">
                                <thead class="text-primary">
                                    <th></th>
                                    <th>Date</th>
                                    <th class="text-center">FAS</th>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Instructor</th>
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
                                @foreach ($aircraft->Flights as $f)
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
                                        <td class="text-center"><a href="{{action('StudentsController@show', $f->student->id)}}" >{{$f->Student->firstName}} {{$f->Student->lastName}}</a></td>
                                        <td class="text-center">
                                            @if ($f->Instructor != null)
                                                <a href="{{action('InstructorsController@show', $f->instructor->id)}}" >{{$f->instructor->firstName}} {{$f->instructor->lastName}}</a>
                                            @else
                                                -
                                            @endif
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

                        <div class="table-responsive">
                            <h3>Fuel Records</h3>
                            <div class="pull-right new-button">
                                <a href="{{action('FuelController@addfuel', $aircraft->id)}}" class="btn btn-primary" title="Add Tab Record"><i
                                            class="fa fa-plus fa-2x"></i> Add Fuel Record</a>
                            </div>
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Price</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                  @foreach($aircraft->FuelUsage as $e)
                                  <tr>
                                    <td class="text-center">
                                      {{date('j/n/Y', strtotime($e->fuelDate))}}
                                    </td>
                                    <td class="text-center">{{$e->fuelAmount}}</td>
                                    <td class="text-center">${{$e->price}}</td>
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
