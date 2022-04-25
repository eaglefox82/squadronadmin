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

    <h2 style="text-align:center">Event Listing</h2>

<div class = "row">

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-university fa-2x"></i>
                    </div>
                    <p class="card-category">Number of Events this Year<br><br></p>
                    <h3 class="card-title">{{$eventsthisyear}}</h3>
                    <a href="" class="card-link"></a>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-book fa-2x"></i>
                    </div>
                    <p class="card-category">Events Remaining this Year<br><br></p>
                    <h3 class="card-title">{{$yearremain}}</h3>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-percent fa-2x"></i>
                    </div>
                    <p class="card-category">Squadron Attendance Rate<br><br></p>
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
                    <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addeventModal" title="Add Event"><i class="fa fa-plus fa-2x"></i> Add Event</button>
                    <a class="btn btn-round btn-success pull-right" title="Past Events" target="_blank" href="{{ action('EventController@listPastEvents') }}"><i class="fa fa-calendar fa-2x"></i> Past Events</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="roll">
                            <thead class = "text-primary">
                                <tr>
                                    <th class="text-center">Date:</th>
                                    <th class="text-center">Event:</th>
                                    <th class="text-center">Event Level:</th>
                                    <th class="text-center">Amount:</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $e)
                                <tr>
                                    <td class="text-center">{{date("l - jS F Y",strtotime($e->event_date))}}</td>
                                    <td class="text-center">{{$e->event}}</td>
                                    <td class="text-center">{{$e->level->level}}</td>
                                    <td class="text-center">${{$e->amount}}</td>
                                    <td>
                                        <a href="{{action('EventController@show', $e->id)}}" title="Show Event Roll" target="_blank" class="btn btn-success btn-round"><i class="fa fa-info"></i></a>
                                        <a href="{{action('EventController@inactive', $e->id)}}" title="Complete Event"  class="btn btn-danger btn-round"><i class="fa fa-check"></i></a></a>

                                    </td>
                                </tr>
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


<div class="modal fade" id="addeventModal" tabindex="-1" role="dialog" aria-labelledby="NewEventLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="addmemberModal">Add Member</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['EventController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                            <label class="label-control">Event Name:</label>
                            <div class="input-group">
                                <input type = "text" class = "form-control" name = "eventname" value="">
                            </div>

                            <label class="label-control">Date of Event:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="eventdate" value="{{$date->format('d-m-Y')}}">
                                    </div>
                                </div>

                            <label class="label-control">Event Type</label>
                            <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="eventlevel" data-size="6">
                                    @foreach ($levels as $l)
                                    <option value ={{$l->id}} >{{$l->level}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="label-control">Cost:</label>
                            <div class="input-group">
                                <input type = "text" class = "form-control" name = "eventcost" value="">
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
