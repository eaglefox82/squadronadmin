@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">Record Term Payment</h4>
                    </div>
                </div>
                {!! Form::open(array('action' => ['TermFeesController@recordpayment'],'method'=>'POST', 'class'=>'form-horizontal')) !!}
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
                    <h2>Record Term Fees for {{ $memberfirst }} {{ $memberlast }}</h2>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Date Paid:</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date" value="{{Carbon\Carbon::now()->format('d-m-Y')}}" required>
                            </div>
                        </div>
                        <input type="hidden" value={{ $recordid }} name="id"/>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{action('TermFeesController@index')}}" class="btn btn-fill">Cancel</a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Add Payment</button>
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
