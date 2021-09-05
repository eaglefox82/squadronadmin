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


        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-university fa-2x"></i>
                    </div>
                    <p class="card-category">Members Attending<br><br></p>
                    <h3 class="card-title">{{$attendance}}</h3>
                    <div class="card-footer">
                        <a href="#planning">Show Members planning to attend</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-check fa-2x"></i>
                    </div>
                    <p class="card-category">Members Attended<br><br></p>
                    <h3 class="card-title">{{$attended}}</h3>
                    <div class="card-footer">
                        <a href="#attended">Show Members in attendance</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
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

        <div class="col-lg-2 col-md-4 col-sm-6">
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

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-user fa-2x"></i>
                    </div>
                    <p class="card-category">Others in Attendance<br><br></p>
                    <h3 class="card-title">{{$others->count()}}</h3>
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
                            <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addpersonModal"><i class="fa fa-plus fa-2x"></i>Add Person to Event</button>
                            <thead class = "text-primary"><h3 class = "text-center">Members Not Attending</h3>
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
                                @if($r->status == 'N')
                                    <tr>
                                        <td class="text-center">{{$r->members->last_name}}, {{$r->members->first_name}}</td>

                                        @if($r->status == 'Y')
                                            <td class="text-center">Planning</td>
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

                                       @if($cost == '0')
                                            <td class = "text-center">-</td>
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
                                                <a href="{{action('EventController@eventform17', ['id' => $r->id, 'others' => 'N'])}}" title="Form 17 Handed In" class="btn btn-primary btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @else
                                                <a href="" title="Form 17 Handed In" class="btn btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @endif

                                            @if($cost == '0')
                                                <a></a>

                                            @elseif($r->paid != "Y")
                                                <a href="{{action('EventController@eventpaid', ['id' => $r->id, 'others' => 'N'])}}" title="Payment Received" class="btn btn-success btn-round"><i class="fa fa-dollar fa-2x"></i></a>

                                            @else
                                                <a href="" title="Payment Received" class="btn btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr></hr>

                    <div class="table-responsive" id="planning">
                        <table class="table" id="roll">
                            <thead class = "text-primary"><h3 class="text-center">Members Planning to Attend</h3>
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

                                @if($r->status == 'Y')
                                    <tr>
                                        <td class="text-center">{{$r->members->last_name}}, {{$r->members->first_name}}</td>

                                        @if($r->status == 'Y')
                                            <td class="text-center">Planning</td>
                                        @else
                                            <td class="text-center">No</td>
                                        @endif

                                        @if($r->form17 == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif

                                       @if($cost == '0')
                                            <td class = "text-center">-</td>
                                        @endif

                                        @if($r->paid == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif
                                        <td class="text-center">
                                                <a href="{{action('EventController@eventattended', ['id' => $r->id, 'others' => 'N'])}}" title="Attended Event" class="btn btn-success btn-round"><i class="fa fa-check fa-2x"></i></a>

                                            @if($r->form17 != "Y")
                                                <a href="{{action('EventController@eventform17', ['id' => $r->id, 'others' => 'N'])}}" title="Form 17 Handed In" class="btn btn-primary btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @else
                                                <a href="" title="Form 17 Handed In" class="btn btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @endif

                                            @if($cost == '0')
                                                <a></a>

                                            @elseif($r->paid != "Y")
                                                <a href="{{action('EventController@eventpaid', ['id' => $r->id, 'others' => 'N'])}}" title="Payment Received" class="btn btn-success btn-round"><i class="fa fa-dollar fa-2x"></i></a>

                                            @else
                                                <a href="" title="Payment Received" class="btn btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @endforeach

                                @foreach($others as $o)
                                    @if($o->status == "Y")

                                    <tr>
                                        <td class="text-center">{{$o->last_name}}, {{$o->first_name}}<br><small style="color:#808080">{{$o->relationship}} of {{$o->member->first_name}} {{$o->member->last_name}}</small></td>

                                        @if($o->status == 'Y')
                                            <td class="text-center">Planning</td>
                                        @else
                                            <td class="text-center">No</td>
                                        @endif

                                        @if($o->form17 == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif

                                       @if($cost == '0')
                                            <td class = "text-center">-</td>
                                        @endif

                                        @if($o->paid == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif
                                        <td class="text-center">
                                                <a href="{{action('EventController@eventattended', ['id' => $o->id, 'others' => 'Y'])}}" title="Attended Event" class="btn btn-success btn-round"><i class="fa fa-check fa-2x"></i></a>

                                            @if($o->form17 != "Y")
                                                <a href="{{action('EventController@eventform17', ['id' =>$o->id, 'others' => 'Y'])}}" title="Form 17 Handed In" class="btn btn-primary btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @else
                                                <a href="" title="Form 17 Handed In" class="btn btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @endif

                                            @if($cost == '0')
                                                <a></a>

                                            @elseif($o->paid != "Y")
                                                <a href="{{action('EventController@eventpaid', ['id' => $o->id, 'others' => 'Y'])}}" title="Payment Received" class="btn btn-success btn-round"><i class="fa fa-dollar fa-2x"></i></a>

                                            @else
                                                <a href="" title="Payment Received" class="btn btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr></hr>

                    <div class="table-responsive" id="attended">
                        <table class="table" id="roll">
                            <thead class = "text-primary"><h3 class="text-center">Members In Attendance</h3>
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

                                @if($r->status == 'A')
                                    <tr>
                                        <td class="text-center">{{$r->members->last_name}}, {{$r->members->first_name}}</td>

                                        @if($r->status == 'A')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center">No</td>
                                        @endif

                                        @if($r->form17 == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif

                                       @if($cost == '0')
                                            <td class = "text-center">-</td>
                                        @endif

                                        @if($r->paid == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif
                                        <td class="text-center">

                                            @if($r->form17 != "Y")
                                                <a href="{{action('EventController@eventform17', ['id' => $r->id, 'others' => 'N'])}}" title="Form 17 Handed In" class="btn btn-primary btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @else
                                                <a href="" title="Form 17 Handed In" class="btn btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @endif

                                            @if($cost == '0')
                                                <a></a>

                                            @elseif($r->paid != "Y")
                                                <a href="{{action('EventController@eventpaid', ['id' => $r->id, 'others' => 'N'])}}" title="Payment Received" class="btn btn-success btn-round"><i class="fa fa-dollar fa-2x"></i></a>

                                            @else
                                                <a href="" title="Payment Received" class="btn btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @endforeach

                                @foreach($others as $o)
                                    @if($o->status == "A")
                                    <tr>
                                        <td class="text-center">{{$o->last_name}}, {{$o->first_name}}<br><small>{{$o->relationship}} of {{$o->member->first_name}} {{$o->member->last_name}}</small></td>

                                        @if($o->status == 'A')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center">No</td>
                                        @endif

                                        @if($o->form17 == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif

                                        @if($o->paid == 'Y')
                                            <td class="text-center">Yes</td>
                                        @else
                                            <td class="text-center" style="color:Red"><strong>No</strong></td>
                                        @endif
                                        <td class="text-center">

                                            @if($o->form17 != "Y")
                                                <a href="{{action('EventController@eventform17', ['id' => $o->id, 'others' => 'Y'])}}" title="Form 17 Handed In" class="btn btn-primary btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @else
                                                <a href="" title="Form 17 Handed In" class="btn btn-round"><i class="fa fa-ticket fa-2x"></i></a>
                                            @endif

                                            @if($cost == '0')
                                                <a></a>

                                            @elseif($o->paid != "Y")
                                                <a href="{{action('EventController@eventpaid', ['id' => $o->id, 'others' => 'Y'])}}" title="Payment Received" class="btn btn-success btn-round"><i class="fa fa-dollar fa-2x"></i></a>

                                            @else
                                                <a href="" title="Payment Received" class="btn btn-round"><i class="fa fa-dollar fa-2x"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addpersonModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class ="modal-title" id="addmemberModal">Add Non Member to Event</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!!Form::open(array('action' => ['EventController@addNonMember'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                    <input type="hidden" name="event" value="{{$id}}">
                        <label class="label-control">First Name:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="firstname" value="">
                        </div>

                        <label class="label-control">Last Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="lastname" value="">
                        </div>

                        <label class="label-control">Member:</label>
                        <div class="input-group">
                            <select type="text" class="selectpicker" data-sytle="select-with-transition" name="member" data-size="6">
                                @foreach ($member as $m)
                                    <option value ={{$m->id}} >{{$m->first_name}} {{$m->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="label-control">Relationship to Member:</label>
                        <div class="input-group">
                            <input type = "text" class = "form-control" name = "relationship" value="">
                        </div>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-round btn-primary">Save Changes</button>
            </div>
            {!!Form::close()!!}
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
