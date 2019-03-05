@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div clas="col-md-12">
            <div class = "card">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">Edit Member</h4>
                    </div>
                </div>
                {!! Form::open(array('action' => ['MembersController@update', $member->id],'method'=>'PUT', 'class'=>'form-horizontal')) !!}
                <input type="hidden" name="member" value = "{{$member->id}}">
                <div class = "card-body">
                        @if (count($errors) >0)
                            <div class = "alert alert-danager">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class = "row">
                            <label class = "col-sm-6 col-form-label">Membership Number:</label>
                            <div class = "col-sm-10">
                                <div class = "form-group">
                                    <input type = "text" class = "form-control" name = "membernumber" value="{{$member->membership_number}}">
                                
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <label class = "col-sm-6 col-form-label">First Name:</label>
                            <div class = "col-sm-10">
                                <div class = "form-group">
                                    <input type = "text" class = "form-control" name = "firstname" value="{{$member->first_name}}">
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <label class = "col-sm-6 col-form-label">Last Name:</label>
                            <div class = "col-sm-10">
                                <div class = "form-group">
                                    <input type = "text" class = "form-control" name = "lastname" value="{{$member->last_name}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-6 col-form-label">Membership Type:</label>
                            <div class = "col-sm-10">
                                <div class = "form-group">
                                    <select type = "text" class ="form-control" name = "type">
                                        <option value ='League'<?php if($member->member_type == "League") echo 'selected="selected"';?>>League Member</option>
                                        <option value ='Associate'<?php if($member->member_type == "Associate") echo 'selected="selected"';?>>Associate Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-6 col-form-label">Rank</label>
                            <div class = "col-sm-10">
                                <div class = "form-group">
                                    <select type="text" class = "form-control" name="rank">
                                        @foreach ($rank as $r)
                                            <option value ={{$r->id}} <?php if($member->rank == $r->id) echo 'selected="selected"';?> >{{$r->rank}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                                


                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="pull-left">
                                    <a href="{{action('MembersController@show', $member->id)}}" class = "btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">Update Member</button>
                                </div>
                            </div>
                        </div>
                    {!!Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


