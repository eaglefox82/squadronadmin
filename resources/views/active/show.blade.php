@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <h4 class="card-title text-center">Active Kids Vouchers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <th class="text-center">Date</th>
                            <th class="text-center">Member</th>
                            <th class="text-center">Membership Number</th>
                            <th class="text-center">D.O.B</th>
                            <th class="text-center">Voucher</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Banking Reference</th>
                            <th width="20%"></th>
                            </thead>
                            <tbody>
                            @foreach($vouchers as $v)
                                <tr>
                                    <td class="text-center">{{date('j/n/Y', strtotime($v->created_at))}}</td>
                                    <td class="text-center">{{$v->member->first_name}} {{$v->member->last_name}}</td>
                                    <td class="text-center">{{$v->member->membership_number}}</td>
                                    <td class="text-center">{{date("jS F Y",strtotime($v->member->date_birth))}}</td>
                                    <td class="text-center">{{$v->voucher_number}}</td>
                                    <td class="text-center">{{$v->type->voucher_type}}</td>
                                    <td class="text-center">{{$v->vstatus->desc}}</td>
                                    <td class="text-center">{{$v->banking_reference}}</td>
                                    @if($v->status != "S")
                                        <td class="text-center">
                                            <a href="{{action('ActiveKidsController@submit', $v->id)}}" class="btn btn-round btn-success" title="Sumbit Voucher">Submitted</a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <a href="#" class="btn btn-round btn-rose" title="Banking Reference" data-target="#addbankingModal" data-toggle="modal" data-voucher_id="{{$v->id}}">Baning Reference</a>
                                            <a href="{{action('ActiveKidsController@complete', $v->id)}}" class="btn btn-round btn-success" title="Complete Voucher">Completed</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addbankingModal" tabindex="-1" role="dialog" aria-labelledby="bankingreferenceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Add Banking Reference</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!!Form::open(array('action' => ['ActiveKidsController@bankingreference'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
        <div class="modal-body">
            <input name="voucherid" id="voucherid">
            <label class="label-control">Reference Number</label>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="bankingreference">
                    </div>
                </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-round">Add Banking Reference</button>
        </div>
    </div>
        {!!Form::close()!!}
    </div>
</div>
</div>

@endsection

@section ('scripts')

<script type="text/javascript">
  $('#addbankingModal').on('show.bs.modal', function(e) {
      var voucherId = $(e.relatedTarget).data('voucher_id');
      var inputF - document.getElementById("voucherid");
      inputF.value = voucherID;
      el_down.innerHTML = "Value =" + "'" + inputF.value  + "'";
      console.log(voucherID);
  });
</script>

@stop
