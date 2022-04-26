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
                        <a href="" class="btn btn-success"  title="Not a button"></i>Parade Nights = {{$totalrolls->count()}}</a>
                    </div>
                    <div class="pull-right new-button">
                        <a href="" class="btn btn-rose"  title="Not a button"></i>Event this Year = {{$totalevents->count()}}</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="attendance">
                            <thead class = "text-primary">
                                <tr>
                                    <th class="text-center">Member</th>
                                    <th class="text-center">Rank</th>
                                    <th class="text-center">Total Weeks Present</th>
                                    <th class="text-center">Total Events Attended</th>
                                    <th width="20%" class="text-center">Attendance Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($memberlist as $r)
                                <tr>
                                    <td class="text-center"><strong>{{$r->last_name}}, {{$r->first_name}}</strong> </td>
                                    <td class="text-center">{{$r->memberrank->rank}}</td>
                                    <td class="text-center">{{$r->attendance->count()}}
                                        <small>
                                            @if($r->attendance->count() !=0)
                                                ({{number_format((($r->attendance->count()/$totalrolls->count())*100),0)}}%)
                                            @else
                                                (0%)
                                            @endif
                                        </small></td>
                                    <td class="text-center">{{$r->event->count()}}
                                        <small>
                                            @if($r->event->count() !=0)
                                                ({{number_format((($r->event->count()/$totalevents->count())*100),0)}}%)
                                            @else
                                                (0%)
                                            @endif
                                        </small>
                                    </td>
                                    <td class="text-center">
                                    @if($r->attendance->count() !=0)
                                        {{number_format((($r->attendance->count() + $r->event->count()) / ($r->memberyear->count() + $r->eventyear()->count()))*100,2)}}
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

@endsection


@section ('scripts')

<script>

</script>



@stop
