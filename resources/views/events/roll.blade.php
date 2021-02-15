@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session()->has('success'))
        <div class="row">
            <div class="col-12 alert alert-success" role="alert">
                <strong>{{session()->get('success')}}</strong>
            </div>
        </div>
    @endif
    @if(session()->has('failure'))
        <div class="row">
            <div class="col-12 alert alert-danger" role="alert">
                <strong>{{session()->get('failure')}}</strong>
            </div>
        </div>
    @endif

    <h2 style="text-align:center">{{$event->event}}</h2>

    <div class = "row">


        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-university fa-2x"></i>
                    </div>
                    <p class="card-category">Members Attending<br><br></p>
                    <h3 class="card-title">{{$attendance}}</h3>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-ticket fa-2x"></i>
                    </div>
                    <p class="card-category">Form 17's Collected<br><br></p>
                    <h3 class="card-title">{{$form17}}</h3>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-dollar fa-2x"></i>
                    </div>
                    <p class="card-category">Members Paid<br><br></p>
                    <h3 class="card-title">{{$paid}}</h3>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-percent fa-2x"></i>
                    </div>
                    <p class="card-category">Attendance Percentage<br><br></p>
                    <h3 class="card-title">{{number_format($percentage,2)}}%</h3>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class = "pull-left">
                        <form cclass="navbar-form">
                            <span class="bmd-form-group">
                                <div class="input-group no-border">
                                    <button class = "btn btn-white btn-round btn-just-icon fa fa-search"></button>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Roll Here"/>
                                </div>
                            </span>
                        </form>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="roll">
                            <thead class = "text-primary">
                                <tr>
                                    <th class="text-center" Width=30%>Member</th>
                                    <th class="text-center">Attendance</th>
                                    <th class="text-center">Form 17 Completed</th>
                                    <th class="text-center">Paid</th>
                                    <th Class="text-center" Width="20%">Attending / Form 17 / Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roll as $r)
                                    <tr>
                                        <td class="text-center">{{$r->members->last_name}}, {{$r->members->first_name}}</td>
                                        @if($r->status == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center">No</td>
                                        @endif

                                        @if($r->form17 == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            @if($r->status == 'Y')
                                                <td class="text-center" style="color:Red"><strong>No</strong></td>
                                            @else
                                                @if ($r->paid == 'Y')
                                                    <td class="text-center" style="color:Red"><strong>No</strong></td>
                                                @else
                                                    <td class="text-center">No</td>
                                                @endif
                                            @endif
                                        @endif

                                        @if($r->paid == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center">No</td>
                                        @endif
                                        <td class="text-center">
                                            @if($r->status != "Y")
                                                <a href="{{action('EventController@eventattending', $r->id)}}" title="Attending" class="btn btn-info btn-round"><i class="fa fa-user-o fa-2x"></i></a>
                                            @else
                                                <a href="" title="Attending" class="btn btn-round"><i class="fa fa-user-o fa-2x"></i></a>
                                            @endif
                                            @if($r->form17 != "Y")
                                                <a href="{{action('EventController@eventform17', $r->id)}}" title="Form 17 Handed In" class="btn btn-primary btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @else
                                                <a href="" title="Form 17 Handed In" class="btn btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @endif
                                            @if($r->paid != "Y")
                                                <a href="{{action('EventController@eventpaid', $r->id)}}" title="Payment Received" class="btn btn-success btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @else
                                                <a href="" title="Payment Received" class="btn btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @endif
                                        </td>
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


@section ('scripts')

<script>

function loadRoll(){
    var x = document.getElementById("rollSelect").value;
    let url = "{{action('RollController@show', [0])}}";
    url = url.replace('0', x);
    window.location = url;
}

   // Write on keyup event of keyword input element
   $(document).ready(function(){
     $("#search").keyup(function(){
     _this = this;

     // Show only matching TR, hide rest of them
     $.each($("#roll tbody tr"), function() {
       if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
       {
           $(this).hide();
       }
       else
       {
          $(this).show();
       }
     });
  });
});



</script>

@stop
