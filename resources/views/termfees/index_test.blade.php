@extends('layouts.app')

@section('content')
    <div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addtermModal" title="Add New Term"><i class="fa fa-plus fa-2x"></i> Add New Term</button>
                                <button class="btn btn-round btn-success">Paid = {{ $status->where('status', "Paid")->count() }} ({{ number_format(($status->where('status', "Paid")->count()/ $status->count())*100,2)}}%)</button>
                                <button class="btn btn-round btn-danger">Outstanding = {{ $status->where('status', "Pending")->count() }} ({{ number_format(($status->where('status', "Pending")->count()/ $status->count())*100,2)}}%)</button>
            <div class="card">
                <div class="card-header card-header-icon card-header-rose text-center">
                    <h2 class="card-title">Term Fees for {{ $year }} - Term {{ $term }}</h2>
                </div>
                <div>
                    <h2 class="card-title text-center">Outstanding</h2>
                </div>

                    <div class="table-responsive">
                         <table class="table" id="termfees">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center">Membership Number</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date Paid</th>
                                    <th class="text-center">Overdue</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($status->where('status', 'Pending') as $s)
                                    <tr>
                                        <td>{{ $s->Member->membership_number }}</td>
                                        <td>{{ $s->Member->first_name }}</td>
                                        <td>{{ $s->Member->last_name }}</td>
                                        <td>{{ $s->status }}</td>
                                        <td>{{ $s->paid_date }}</td>
                                        <td>{{ $s->overdue }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-round termpayment" title="Add Payment" data-id="{{ $s->id }}" data-toggle="modal" data-target="#termpaymentModal"><i class="fa fa-dollar"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>

                    <div>
                    <h2 class="card-title text-center">Paid</h2>
                </div>

                    <div class="table-responsive">
                         <table class="table" id="termfees">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center">Membership Number</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date Paid</th>
                                    <th class="text-center">Overdue</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($status->where('status', 'Paid') as $s)
                                    <tr>
                                        <td>{{ $s->member->membership_number }}</td>
                                        <td>{{ $s->member->first_name }}</td>
                                        <td>{{ $s->member->last_name }}</td>
                                        <td>{{ $s->status }}</td>
                                        <td>{{ $s->paid_date }}</td>
                                        <td>{{ $s->overdue }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-round termpayment" title="Add Payment" data-id="{{ $s->id }}" data-toggle="modal" data-target="#termpaymentModal"><i class="fa fa-dollar"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="addtermModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="addtermModal">Add Term</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['TermFeesController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                            <label class="label-control">Term Number:</label>
                            <div class="input-group">
                                <input type = "text" class = "form-control" name = "term" value="" required>
                            </div>

                            <label class="label-control">Start of Term:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="date" value="{{Carbon\Carbon::now()->format('d-m-Y')}}" required>
                                    </div>
                                </div>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                    <button type="submit" class="btn btn-round btn-primary">Add Term</button>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="termpaymentModal" tabindex="-1" role="dialog" aria-labelledby="termpaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="termpaymentModalLabel">Add Payment</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(array('action' => ['TermFeesController@recordpayment'], 'method'=>'POST', 'class'=>'form-horizontal')) !!}
                <div class="modal-body">
                            <label class="label-control">Payment Date:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="date" value="{{Carbon\Carbon::now()->format('d-m-Y')}}" required>
                                    </div>
                                </div>

                                <div class="form group">
                                    <div class="input-group">
                                        <input class="form-control" name="memberId" id="idHolder" value="idHolder" type="hidden"  class="form-control"/>

                                    </div>
                                </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                    <button type="submit" class="btn btn-round btn-primary">Add Term</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>



</div>

@endsection

@section ('scripts')
<script>

    $(document).on('click', '.termpayment', function() {
    var memberId = $(this).data('id');
    $('#idHolder').val(memberId);
    });
</script>

@stop

