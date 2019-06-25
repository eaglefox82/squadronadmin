<!--'@extends('layouts.app')

@section('content') -->
    <div class='container-fluid'>
        <div class = 'row'>
            <div class="col-sm-6">
                <div class="card">
                    <div class = "card-header card-header-rose card-header-text">
                        <div class = "card-text">
                            <h4 class="card-title">Add new Request</h4>
                        </div>
                    </div>
                    {!!Form::open(array('action' => ['MembersController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
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
                            <label class = "col-sm-2 col-form-label">Membership Number:</label>
                            <div class = "col-sm-10">
                                <input type = "text" class="form-control" name="membership">
                            </div>
                        </div>
                        
                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">First Name</label>
                            <div class = "col-sm-10">
                                <input type = "text" class = "form-control" name="firstname">
                            </div>
                        </div>
                        
                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Last Name</label>
                            <div class = "col-sm-10">
                                <input type = "text" class = "form-control" name="lastname">
                            </div>
                        </div>

                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Rank</label>
                            <div class = "col-sm-10">
                                <select type="text" class = "selectpicker"  Data-style="select-with-transition" name="rank" data-size="6">
                                    @foreach ($rank as $r)
                                        <option value ={{$r->id}}>{{$r->rank}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Date of Joining:</label>
                            <div class = "col-sm-10 form-group">
                                <input type = "text" class = "form-control datepicker" name="doj" value="{{Carbon\Carbon::now()->toDateString()}}">
                            </div>
                        </div>

                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Date of Birth:</label>
                            <div class = "col-sm-10">
                                <input type = "text" class = "form-control datepicker" name="dob" value="{{Carbon\Carbon::now()->toDateString()}}">
                            </div>
                        </div>

                        <div class = "card-footer">
                            <div class = "row">
                                <div class ="col-md-4">
                                    <a href="{{action('MembersController@index')}}" class="btn btn-danger">cancel</a>
                                </div>
                                &nbsp;
                                <div class = "col-md-4">
                                    <button type = "submit" class = "btn btn-primary">Add Member</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

 <!-- @endsection

  @section ('scripts') -->

    <script>
        $(document).ready(function() {
          // initialise Datetimepicker and Sliders
          md.initFormExtendedDatetimepickers();
          if ($('.slider').length != 0) {
            md.initSliders();
          }
        });
      </script>
@endsection