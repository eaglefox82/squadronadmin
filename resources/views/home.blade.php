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

                    You are logged in!
                </div>
            </div>
        </div>
      </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-university fa-2x"></i>
                    </div>
                    <p class="card-category">Number in Camp<br><br></p>
                <h3 class ="card-title">{{$students->where('campForm',1)->count()}}</h3>
              </div>
                <div class="card-footer">
                </div>
            </div>
        </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                  <div class="card-header card-header-primary card-header-icon">
                      <div class="card-icon">
                          <i class="fa fa-fighter-jet fa-2x"></i>
                      </div>
                      <p class="card-category">Total Flights<br><br></p>
                  <h3 class ="card-title">{{$totalflights->count()}}</h3>
                </div>
                  <div class="card-footer">
                  </div>
              </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-plane fa-2x"></i>
                    </div>
                    <p class="card-category">Total Flight Hours<br><br></p>
                <h3 class ="card-title">{{$totalflights->sum('hours')}}</h3>
              </div>
                <div class="card-footer">
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                      <i class="fa fa-anchor fa-2x"></i>
                  </div>
                  <p class="card-category">Total Landings<br><br></p>
              <h3 class ="card-title">{{$totalflights->sum('landings')}}</h3>
            </div>
              <div class="card-footer">
              </div>
          </div>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-money fa-2x"></i>
                    </div>
                    <p class="card-category">Total Flight Income<br><br></p>
                <h3 class ="card-title">${{number_format((float)$totalflights->sum('flightTotal'),2)}}</h3>
              </div>
                <div class="card-footer">
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-credit-card fa-2x"></i>
                    </div>
                    <p class="card-category">Total Fuel Burnt<br><br></p>
                <h3 class ="card-title">${{number_format((float)$fuel->sum('price'),2)}}</h3>
              </div>
                <div class="card-footer">
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-truck fa-2x"></i>
                    </div>
                    <p class="card-category">Total Fuel Burnt<br><br></p>
                <h3 class ="card-title">{{$fuel->sum('fuelAmount')}}L</h3>
              </div>
                <div class="card-footer">
                </div>
            </div>
        </div>

      </div>


</div>
@endsection
