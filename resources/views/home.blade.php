@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div> 
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            Welcome {{ Auth::user()->firstname }}
                        </div>
                </div>
            </div>
        </div>
        <div class = "row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Members Present<br><br></p>
                        <h3 class="card-title">{{$currentroll->count()}}</h3>
                        <a href="{{action('RollController@index')}}" class="card-link">View Roll</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-book fa-2x"></i>
                        </div>
                        <p class="card-category">Members on Roll<br><br></p>
                        <h3 class="card-title">{{$members->where ('active','Y')->count()}}</h3>
                        <a href="{{action('MembersController@create')}}" class="card-link">Add New Member</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-percent fa-2x"></i>
                        </div>
                        <p class="card-category">Sqn Attendance<br><br></p>
                            <div class = "card-title c100 p{{number_format(($currentroll->count()/$members->where ('active','Y')->count())*100),2}} green">
                                <span>{{number_format(($currentroll->count()/$members->where ('active','Y')->count())*100),2}}%</span>
                                    <div class="slice">
                                        <div class="bar"></div>
                                        <div class="fill"></div>
                                    </div>
                            </div>

                        <!--<h3 class="card-title">{{number_format(($currentroll->count()/$members->where ('active','Y')->count())*100),2}}%</h3> -->
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-child fa-2x"></i>
                        </div>
                        <p class="card-category">Active Kids<br><br></p>
                        <h3 class="card-title">{{$active->where('active','Y')->count()}}</h3>
                        <a href="{{action('ActiveKidsController@index')}}" class='card-link'>View Vouchers</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-o fa-2x"></i>
                        </div>
                        <p class="card-category">Officers Present<br><br></p>
                        <h3 class="card-title">{{$officers->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                        <p class="card-category">WO/TO's Present<br><br></p>
                        <h3 class="card-title">{{$to->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-angle-double-down fa-2x"></i>
                        </div>
                        <p class="card-category">NCOs Present<br><br></p>
                        <h3 class="card-title">{{$nco->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-group fa-2x"></i>
                        </div>
                        <p class="card-category">Cadets Present<br><br></p>
                        <h3 class="card-title">{{$cadet->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-usd fa-2x"></i>
                        </div>
                        <p class="card-category">Subs Collected<br><br></p>
                         <h3 class="card-title">${{$total}}</h3>
                        <a href="{{action('RollController@index')}}" class='card-link'>View Roll</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
    </div>


</div>
@endsection
