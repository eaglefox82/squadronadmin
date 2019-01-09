@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">Check-in Student</h4>
                    </div>
                </div>
                {!! Form::open(array('action' => ['StudentsController@completeCheckIn', $student->id],'method'=>'POST', 'class'=>'form-horizontal')) !!}
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
                            <label class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <p>
                                        {{$student->firstName}} {{$student->lastName}} ({{$student->squadron}})
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Camp F17a Received:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select class="form-control" name="campForm">
                                        <option value="0">No</option>
                                        <option value="1" selected>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Camp Payment Received:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select class="form-control" name="campPayment">
                                        <option value="0">No</option>
                                        <option value="1" selected>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Requested Hours:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="hours" value="{{$student->hoursRequested}}" step="0.1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Student Information Check</h4>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">ARN:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="arn" value="{{$student->arn}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Valid Medical:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select class="form-control" name="medical">
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">English Evidence Received:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select class="form-control" name="english">
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Notes:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="notes" value="{{$student->notes}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Additional Items</h4>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Requested Items:</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Required</th>
                                                <th>Name</th>
                                                <th>Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="items[]" value="kit"></td>
                                                <td>Student Pilot Kit ($205.00)</td>
                                                <td><input type="checkbox" name="paid[]" value="kit"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="items[]" value="logbook"></td>
                                                <td>Log Book ($30.00)</td>
                                                <td><input type="checkbox" name="paid[]" value="logbook"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="items[]" value="vtc"></td>
                                                <td>Sydney VTC ($16.00)</td>
                                                <td><input type="checkbox" name="paid[]" value="vtc"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="items[]" value="shirt"></td>
                                                <td>Air Activities Shirt ($30.00)</td>
                                                <td><input type="checkbox" name="paid[]" value="shirt"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{action('StudentsController@index')}}" class="btn btn-fill">Cancel</a>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Complete Check-in</button>
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

@section ('scripts')

@endsection