@extends('layouts.app')

@section ('content')
    <div class='container-fluid'>
        <div class = 'row'>
            <div class="col-sm-12">
                <div class="card">
                    <div class = "card-header card-header-rose card-header-text">
                        <div class = "card-text">
                            <h4 class="card-title">Active Kids Voucher</h4>
                        </div>
                    </div>
                    {!!Form::open(array('action' => ['ActiveKidsController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                    <input type = "hidden" name = "member" value = "{{$member->id}}">
                    <div class = "card-body">
                        @if (count($errors) > 0)
                            <div class ="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Date: </label>
                            <div class = "col-sm-10">
                                <input type = "date" class="form-control" name="date" value="{{Carbon\Carbon::now()->toDateString()}}">
                            </div>
                        </div>
                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Voucher Number: </label>
                            <div class = "col-sm-10">
                                <input type = "text" class = "form-control" name="voucher">
                            </div>
                        </div>

                        <div class = "card-footer">
                            <div class = "row">
                                <div class ="col-md-4">
                                    <a href="{{action('MembersController@show', $member->id)}}" class="btn btn-danger">cancel</a>
                                </div>
                                &nbsp;
                                <div class = "col-md-4">
                                    <button type = "submit" class = "btn btn-primary">Add Voucher</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
