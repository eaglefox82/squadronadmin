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
                        <h3 class="card-title">count</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Members on Roll<br><br></p>
                        <h3 class="card-title">count</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Active Kids<br><br></p>
                        <h3 class="card-title">count</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
    </div>


</div>
@endsection
