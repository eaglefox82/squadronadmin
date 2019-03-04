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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class = "pull-left">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Roll Here"/>
                    </div>                
                    <div class="pull-right new-button">
                        <a href="{{action('RollController@create')}}" class="btn btn-primary" title="Create New Roll"><i class="fa fa-plus fa-2x"></i>Create New Roll</a>
                    </div>
                </div>
                <div class="card-body">
    
                    <div class="table-responsive">
                        <table class="table" id="roll">
                            <thead>
                            <h4> Roll Date: {{date("l - jS F Y",strtotime($rolldate))}}</h4>
                                <tr>
                                    <th width="20%"></th>    
                                    <th class="text-center">Member</th>
                                    <th width = "20%" class="text-center">Rank</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-center">Voucher Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($member as $r)
                                <tr>
                                    <td class="text-center">
                                        @if ($r->status == 'A')
                                        <a href="{{action('RollController@paid', $r->id)}}" title="Paid" class="btn btn-success"><i class="material-icons">done</i></a>
                                        <a href="{{action('RollController@voucher', $r->id)}}"  title="Voucher" class="btn btn-info"><i class ="material-icons">local_activity</i></a>
                                        <a href="{{action('RollController@notpaid', $r->id)}}" title="Paid" class="btn btn-danger"><i class="material-icons">close</i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$r->member->last_name}}, {{$r->member->first_name}} </td>
                                    <td class="text-center">{{$r->member->memberrank->rank}}</td>
                                    <td class="text-center">{{$r->rollstatus->status}}</td>
                                    <td class="text-center">${{$r->ActiveKids->sum('balance')}}</td>
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