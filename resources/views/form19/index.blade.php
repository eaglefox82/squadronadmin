@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class = "col-sm-12">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Form 19</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th class="text-center">Details</th>
                                @for($i = 1; $i <= $nightsInMonth; $i++)
                                    <th class="text-center">Week {{$i}}</th>
                                @endfor
                                <th class="text-center">Total</th>
                            </tr>
                            <tr>
                                @php
                                    $total = 0;
                                @endphp
                                <th class="text-center">Officer:</th>
                                @for($i = 1; $i <= $nightsInMonth; $i++)
                                    @php
                                        $count = 0;
                                        $week = $monthlyRoll->where('roll_week', $i)->first();
                                        if($week != null)
                                        {
                                            $count = $week->officercount();
                                        }
                                        $total += $count;
                                    @endphp
                                    <td class="text-center">{{$count}}</td>
                                @endfor
                                <td class="text-center">{{$total}}</td>
                            </tr>
                            <tr>
                                @php
                                    $total = 0;
                                @endphp
                                <th class="text-center">TO/WO:</th>
                                @for($i = 1; $i <= $nightsInMonth; $i++)
                                    @php
                                        $count = 0;
                                        $week = $monthlyRoll->where('roll_week', $i)->first();
                                        if($week != null)
                                        {
                                            $count = $week->tocount();
                                        }
                                        $total += $count;
                                    @endphp
                                    <td class="text-center">{{$count}}</td>
                                @endfor
                                <td class="text-center">{{$total}}</td>
                            </tr>
                            <tr>
                                @php
                                    $total = 0;
                                @endphp
                                <th class="text-center">NCO:</th>
                                @for($i = 1; $i <= $nightsInMonth; $i++)
                                    @php
                                        $count = 0;
                                        $week = $monthlyRoll->where('roll_week', $i)->first();
                                        if($week != null)
                                        {
                                            $count = $week->ncocount();
                                        }
                                        $total += $count;
                                    @endphp
                                    <td class="text-center">{{$count}}</td>
                                @endfor
                                <td class="text-center">{{$total}}</td>
                            </tr>
                            <tr>
                                @php
                                    $total = 0;
                                @endphp
                                <th class="text-center">Cadets:</th>
                                @for($i = 1; $i <= $nightsInMonth; $i++)
                                    @php
                                        $count = 0;
                                        $week = $monthlyRoll->where('roll_week', $i)->first();
                                        if($week != null)
                                        {
                                            $count = $week->cadetcount();
                                        }
                                        $total += $count;
                                    @endphp
                                    <td class="text-center">{{$count}}</td>
                                @endfor
                                <td class="text-center">{{$total}}</td>
                            </tr>
                            <tr>
                                @php
                                    $total = 0;
                                @endphp
                                <th class="text-center">Total:</th>
                                @for($i = 1; $i <= $nightsInMonth; $i++)
                                    @php
                                        $count = 0;
                                        $week = $monthlyRoll->where('roll_week', $i)->first();
                                        if($week != null)
                                        {
                                            $count = $week->total();
                                        }
                                        $total += $count;
                                    @endphp
                                    <td class="text-center">{{$count}}</td>
                                @endfor
                                <td class="text-center">{{$total}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @php
            $monthTotal = 0;

            foreach($monthlyRoll as $roll)
            {
                $monthTotal += $roll->total();
            }
        @endphp

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money fa-2x"></i>
                        </div>
                        <p class="card-category">Total Group Levies<br><br></p>
                        <h3 class="card-title">${{number_format(($monthTotal*2.5),2)}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money fa-2x"></i>
                        </div>
                        <p class="card-category">Total wing Levies<br><br></p>
                        <h3 class="card-title">${{number_format(($monthTotal*0.15),2)}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money fa-2x"></i>
                        </div>
                        <p class="card-category">Total Subs<br><br></p>
                        <h3 class="card-title">${{number_format(($monthTotal*10),2)}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection