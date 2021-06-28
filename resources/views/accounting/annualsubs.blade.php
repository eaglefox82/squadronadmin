@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose pull-center">
                    <h2 class="card-title text-center">Members for Annual Subs</h2>
                </div>
                <div class="table-responsive">
                    <table class="table" id="membertable">
                        <thead class="text-primary">
                            <th></th>
                            <th class="text-center">Membership Number</th>
                            <th class="text-center">Name</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($members->where('annualsubs','Y') as $m )
                            <tr
                            @if($m->attendancewarning == 3)
                                bgcolor="#FED3D4"
                            @endif
                            >
                                <td class="text-center">
                                    <a href="{{action('MembersController@show', $m->id)}}" target="_blank" title="View" class="btn btn-round btn-success"><i class="fa fa-info"></i></a>
                                </td>
                                <td class="text-center">{{$m->membership_number}}</td>
                                <td class="text-center">{{$m->last_name}}, {{$m->first_name}}</td>
                                @if($m->attendancewarning == 3)
                                    <td class="text-center" title="Attendance Warning"><i class="fa fa-exclamation fa-2x"></i></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr></tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


