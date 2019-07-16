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
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class = "pull-left">
                        <form cclass="navbar-form">
                        </form>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <h3 class="text-center"> Outstanding Subs</h3>
                        <table class="table" id="roll">
                            <thead class = "text-primary">
                                    <th width="20%"></th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Outstanding Subs Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($outstandingSubs as $o)
                                @if ($o->outstanding->count() > 0)
                                <tr>
                                    <td>
                                        <a href="{{action('MembersController@show', $o->id)}}" title="Show Member" class="btn btn-danger btn-round"><i class="fa fa-info"></i></a>
                                    </td>
                                    <td class="text-center">{{$o->last_name}}</td>
                                    <td class="text-center">{{$o->first_name}}</td>
                                    <td class="text-center">${{($o->outstanding->count())*10}}</td>
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


@endsection


@section ('scripts')
<script>
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
