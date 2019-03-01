@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class = "col-sm-12">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">From 19</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th class="text-center">Details</th>
                                <th class="text-center">Week 1</th>
                                <th class="text-center">Week 2</th>
                                <th class="text-center">Week 3</th>
                                <th class="text-center">Week 4</th>
                                <th class="text-center">Week 5</th>
                                <th class="text-center">Total</th>
                            </tr>
                            <tr>
                                <th class="text-center">Officer:</th>
                                <td class="text-center">{{$officerwk1->count()}}</td>
                                <td class="text-center">{{$officerwk2->count()}}</td>
                                <td class="text-center">{{$officerwk3->count()}}</td>
                                <td class="text-center">{{$officerwk4->count()}}</td>
                                <td class="text-center">{{$officerwk5->count()}}</td>
                                <td class="text-center">{{$totalofficer->count()}}</td>
                            </tr>
                            <tr>
                                <th class="text-center">TO/WO:</th>
                                <td class="text-center">{{$towk1->count()}}</td>
                                <td class="text-center">{{$towk2->count()}}</td>
                                <td class="text-center">{{$towk3->count()}}</td>
                                <td class="text-center">{{$towk4->count()}}</td>
                                <td class="text-center">{{$towk5->count()}}</td>
                                <td class="text-center">{{$totalto->count()}}</td>
                            </tr>
                            <tr>
                                <th class="text-center">NCO:</th>
                                <td class="text-center">{{$ncowk1->count()}}</td>
                                <td class="text-center">{{$ncowk2->count()}}</td>
                                <td class="text-center">{{$ncowk3->count()}}</td>
                                <td class="text-center">{{$ncowk4->count()}}</td>
                                <td class="text-center">{{$ncowk5->count()}}</td>
                                <td class="text-center">{{$totalnco->count()}}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Cadets:</th>
                                <td class="text-center">{{$cadetwk1->count()}}</td>
                                <td class="text-center">{{$cadetwk2->count()}}</td>
                                <td class="text-center">{{$cadetwk3->count()}}</td>
                                <td class="text-center">{{$cadetwk4->count()}}</td>
                                <td class="text-center">{{$cadetwk5->count()}}</td>
                                <td class="text-center">{{$totalcadet->count()}}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Total:</th>
                                <td class="text-center">{{$totalwk1->count()}}</td>
                                <td class="text-center">{{$totalwk2->count()}}</td>
                                <td class="text-center">{{$totalwk3->count()}}</td>
                                <td class="text-center">{{$totalwk4->count()}}</td>
                                <td class="text-center">{{$totalwk5->count()}}</td>
                                <td class="text-center">{{$total->count()}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class = "row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money fa-2x"></i>
                        </div>
                        <p class="card-category">Total Group Levies<br><br></p>
                        <h3 class="card-title">${{number_format(($total->count()*2.5),2)}}</h3>
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
                        <h3 class="card-title">${{number_format(($total->count()*0.15),2)}}</h3>
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
                        <h3 class="card-title">${{number_format(($total->count()*10),2)}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection