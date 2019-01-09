@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">{{$student->firstName}} {{$student->lastName}} Tab</h4>
                    </div>
                </div>
                {!! Form::open(array('action' => ['TabsController@store'],'method'=>'POST', 'class'=>'form-horizontal')) !!}
                <input type="hidden" name="student" value="{{$student->id}}">
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
                        <label class="col-sm-2 col-form-label">Amount: $</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="number" class="form-control" name="amount" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{action('StudentsController@show', $student->id)}}" class="btn btn-fill">Cancel</a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Add Tab</button>
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
