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
                                    <th class="text-center">Date:</th>
                                    <th class="text-center">Event:</th>
                                    <th class="text-center">Event Level:</th>
                                    <th class="text-center">Amount:</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($event as $e)
                                <tr>
                                    <td class="text-center">{{date("l - jS F Y",strtotime($e->event_date))}}</td>
                                    <td class="text-center">{{$e->event}} - {{ date("Y",strtotime($e->event_date)) }}</td>
                                    <td class="text-center">{{$e->level->level}}</td>
                                    <td class="text-center">${{$e->amount}}</td>
                                    <td>
                                        <a href="{{action('EventController@show', $e->id)}}" title="Show Event Roll" target="_blank" class="btn btn-success btn-round"><i class="fa fa-info"></i></a>
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
