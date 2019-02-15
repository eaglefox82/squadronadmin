@extends('layouts.app')

@section('content')
    <div class='container-fluid'>
        <div class = 'row'>
            <div class="col-sm-12">
                <div class="card">
                    <div class = "card-header card-header-rose card-header-text">
                        <div class = "card-text">
                            <h4 class="card-title">Create New Roll</h4>
                        </div>
                    </div>
                    {!!Form::open(array('action' => ['RollController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
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
                            <label class = "col-sm-2 col-form-label">Roll Date</label>
                            <div class = "col-sm-10">
                                <input type = "date" class = "form-control" name="rolldate" value="{{Carbon\Carbon::now()->toDateString()}}">
                            </div>
                        </div>

                        <div class = "card-footer">
                            <div class = "row">
                                <div class ="col-md-4">
                                    <a href="{{action('RollController@index')}}" class="btn btn-danger">cancel</a>
                                </div>
                                &nbsp;
                                <div class = "col-md-4">
                                    <button type = "submit" class = "btn btn-primary">Create Roll</button>
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