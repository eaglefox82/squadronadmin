@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">Add Expense</h4>
                    </div>
                </div>
                {!! Form::open(array('action' => ['AccountingController@store'],'method'=>'POST', 'class'=>'form-horizontal')) !!}
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Date:</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date" value="{{Carbon\Carbon::now()->toDateString()}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Details:</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" class="form-control" name="details">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Submitted By:</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" class="form-control" name="submitted">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Amount: $</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="number" class="form-control" name="amount" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Pending:</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select class="form-control" name="pending">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{action('AccountingController@index')}}" class="btn btn-fill">Cancel</a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Add Expense</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection