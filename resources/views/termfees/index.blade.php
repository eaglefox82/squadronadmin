@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addtermModal" class="btn btn-primary btn-round" title="Add New Term"><i class="fa fa-plus fa-2x"></i> Add New Term</button>
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose pull-center">
                        <h2 class="card-title text-center">Term Fees for {{ $year }} - Term {{ $term }}</h2>
                    </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-no-boreded table-hover" width="100%" id="termfee-table">
                                <thead class="text-primary">
                                    <th class="text-center">Membership Number</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date Paid</th>
                                    <th class="text-center">Actions</th>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                                <tfooter>
                                    <tr>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
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

    <div class="modal fade" id="termpaymentModal" tabindex="-1" role="dialog" aria-labelledby="TermPayment" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="termpaymentModal">Add Payment</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['TermFeesController@recordpayment'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">

                            <label class="label-control">Payment Date:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="date" value="{{Carbon\Carbon::now()->format('d-m-Y')}}" required>
                                    </div>
                                </div>
                                <input name="memberid", id="id"/>
                                    <span id="idHolder"></span>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                    <button type="submit" class="btn btn-round btn-primary">Add Term</button>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>



</div>

@endsection

@section ('scripts')
<script>
    $(function() {

        var table=$('#termfee-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            ajax: '{{ route('getTermFees') }}',
            columns: [
                { data: 'membership'},
                { data: 'first_name'},
                { data: 'last_name'},
                { data: 'status'},
                { data: 'paid_date'},
                { data: 'action', orderable: false, searchable: false}
            ],
        });
    })

</script>

<script type="text/javascript">
    $(document).on("click", ".termpayment", function() {
        var memberId = $(this).data('id');
        $(".model-body #id").val(memberId);
    });
</script>


@stop

