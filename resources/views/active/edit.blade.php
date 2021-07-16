@extends ('layouts.app')

@section('content')

<div class="container-fliud">
    <div class="container-fliud">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header card-header-rose card-header-text">
                        <div class="card-text">
                            <h4 class="card-title">Add Banking Reference</h4>
                        </div>
                    </div>
                    {!! Form::open(array('action' => ['ActiveKidsController@bankingreference', $voucher->id],'method'=>'POST', 'class'=>'form-horizontal')) !!}
                    <div class = "card-body">
                        @if (count($errors)>0)
                            <div class = "alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Voucher Number: </label>
                            <div class = "col-sm-6">
                                <div class = "form-group">
                                    <input type = "text" class = "form-control" name="Voucher Number" value="{{$voucher->voucher_number}}">
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <label class = "col-sm-2 col-form-label">Value: </label>
                            <div class = "col-sm-6">
                                <div class = "form-group">
                                    <input type = "text" class = "form-control" name="banking_reference">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "card-footer">
                        <div class = "row">
                            <div class = "col-md-4">
                                <div class="pull-left">
                                        <a href="{{action('ActiveKidsController@index')}}" class = "btn btn-danger">Cancel</a>
                                </div>
                            </div>
                            <div class ="col-md-4">
                                <button type="submit" class="btn btn-success">Add Reference Number</button>
                            </div>
                        </div>
                    </div>
                    {!!Form::close()!!}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

