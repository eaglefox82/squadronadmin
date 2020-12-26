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
                <h2 class="text-center">Year Attendance Overview</h2>
                <div class="card-header card-header-icon card-header-rose">
                  <div class="pull-right new-button">
                        <a href="" class="btn btn-success"  title="Not a button"></i>Total Weeks = {{$totalweeks->count()}}</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="roll">
                            <thead class = "text-primary">
                                <tr>
                                    <th class="text-center">Member</th>
                                    <th class="text-center">Rank</th>
                                    <th class="text-center">Total Weeks Present</th>
                                    <th width="20%" class="text-center">Attendance Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($memberlist as $r)
                                <tr>
                                    <td class="text-center"><strong>{{$r->last_name}}, {{$r->first_name}}</strong> </td>
                                    <td class="text-center">{{$r->memberrank->rank}}</td>
                                    <td class="text-center">{{$r->attendance->count()}}</td>
                                    <td class="text-center">
                                    @if($r->attendance->count() !=0)
                                        {{number_format(($r->attendance->count()/$r->memberyear->count())*100),2}}
                                    @else
                                        0
                                    @endif  
                                    %</td>
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

<div class="modal fade" id="newrollModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">New Roll</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!!Form::open(array('action' => ['RollController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">
                    <div class="form-group">
                        <label class="label-control">Enter Date:</label>
                            <div class="input-group">
                                <input type="text" class="form-control datetimepicker" name="rolldate" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-round">Create Roll</button>
            </div>
            {!!Form::close()!!}
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
