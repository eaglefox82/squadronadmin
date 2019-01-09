@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Student Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>First Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$student->firstName}}</td>
                                <th>Last Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$student->lastName}}</td>
                            </tr>
                            <tr>
                                <th>Age:</th>
                                <td>{{$student->age}} years</td>
                                <th>Unit:</th>
                                <td>{{$student->squadron}}</td>
                            </tr>
                            <tr>
                                <th>ARN:</th>
                                <td>{{$student->arn}}</td>
                                <th>Aircraft Type:</th>
                                <td>{{$student->aircraftType}}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    {{$student->email}}
                                </td>
                                <th>Address:</th>
                                <td>
                                    {{$student->address}}
                                </td>
                            </tr>
                            <tr>
                                <th>Notes:</th>
                                <td colspan="3">
                                    {{$student->notes}}
                                </td>
                            </tr>
                            <tr>
                                <th>Hours Requested:</th>
                                <td>
                                    <h4>{{$student->hoursRequested}}</h4>
                                </td>
                                <th>Hours Completed:</th>
                                <td>
                                    <h4>{{$student->HoursFlown()}}</h4>
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
                                    <th class="text-center">Aircraft</th>
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
                                @foreach ($student->Flights as $f)
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
                            <h3>Additional Items</h3>
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Paid</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($student->AdditionalItems as $i)
                                    <tr>
                                        <td class="text-center">{{$i->name}}</td>
                                        <td class="text-center">${{$i->amount}}</td>
                                        <td class="text-center">
                                            @if($i->paid == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <h3>Account Payments</h3>
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Method</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($student->Payments as $p)
                                    <tr>
                                        <td class="text-center">{{date('j/n/Y', strtotime($p->paymentDate))}}</td>
                                        <td class="text-center">{{$p->Item->name}}</td>
                                        <td class="text-center">${{$p->amount}}</td>
                                        <td class="text-center">{{$p->method}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <h3>Canteen Tab - Balance ${{number_format($student->Tabs->sum('amount'),2)}}</h3>
                            <div class="pull-right new-button">
                                <a href="{{action('TabsController@createtab', $student->id)}}" class="btn btn-primary" title="Add Tab Record"><i
                                            class="fa fa-plus fa-2x"></i> Add Tab Record</a>
                            </div>
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Amount</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                  @foreach ($student->Tabs as $t)
                                    <tr>
                                        <td class="text-center">{{date('j/n/Y', strtotime($t->created_at))}}</td>
                                        <td class="text-center">${{$t->amount}}</td>
                                        <td></td>
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
