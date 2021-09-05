@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class = "col-sm-12">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="pull-right new-button">
                            <a data-toggle="modal" data-target="" class="btn btn-gray btn-round" title="Add Voucher"><i class="fa fa-plus fa-2x"></i>Print Form 19</a>
                        </div>
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
                                <th class="text-center" style="background-color:#dee0e3" Width = "10%">Number on Roll</th>
                                <th class="text-center" style="background-color:#dee0e3" Width = "10%">Increase this Month</th>
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
                                <td class="text-center" style="background-color:#dee0e3">{{$totalmember->where('rank', '<', 12)->count()}}</td>
                                <td class="text-center" style="background-color:#dee0e3">{{$newmembers->where('rank', '<', 12)->count()}}</td>
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
                                <td class="text-center" style="background-color:#dee0e3">{{$totalmember->where('rank', 13)->count()}}</td>
                                <td class="text-center" style="background-color:#dee0e3">{{$newmembers->where('rank', 13)->count()}}</td>
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
                                <td class="text-center" style="background-color:#dee0e3">{{$totalmember->where('rank','>', 13)->where('rank','<', 19)->count()}}</td>
                                <td class="text-center" style="background-color:#dee0e3">{{$newmembers->where('rank','>', 13)->where('rank','<', 19)->count()}}</td>
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
                                <td class="text-center" style="background-color:#dee0e3">{{$totalmember->where('rank','>', 18)->count()}}</td>
                                <td class="text-center" style="background-color:#dee0e3">{{$newmembers->where('rank','>', 18)->count()}}</td>
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
                                <td class="text-center" style="background-color:#dee0e3">{{$totalmember->count()}}</td>
                                <td class="text-center" style="background-color:#dee0e3">{{$newmembers->count()}}</td>
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
                        <h3 class="card-title">${{number_format(($monthTotal*$groupfee),2)}}</h3>
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
                        <h3 class="card-title">${{number_format(($monthTotal*$wing),2)}}</h3>
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
                        <h3 class="card-title">${{number_format(($monthTotal*$groupfee),2)}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-group fa-2x"></i>
                        </div>
                        <p class="card-category">Avg Attendance<br><br></p>
                        <h3 class="card-title">{{number_format(($total/$meetingnights),2)}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-group fa-2x"></i>
                        </div>
                        <p class="card-category">Total Meeting Nights <br><br></p>
                        <h3 class="card-title">{{$meetingnights}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-plus fa-2x"></i>
                        </div>
                        <p class="card-category">New Members this Month <br><br></p>
                        <h3 class="card-title">{{$newmembers->count()}}</h3>
                        <div class="card-footer">
                            <a href="{{action ('MembersController@newmembers')}}">View new members</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="addform19reportrModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="addaccountModal">Add General Report</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['Form19Controller@printForm'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                        <label class ="label-control">Enter Report</label>
                            <div class="form-group">
                                <textarea  name="report" autocomplete="off" cols="90" rows="10"></textarea>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-round btn-primary">Download Report</button>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>



@endsection

