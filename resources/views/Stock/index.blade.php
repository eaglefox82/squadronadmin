@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session()->has('success'))
        <div class="row">
            <div class="col-12 alert alert-success" role="alert">
                <strong>{{session()->get('success')}}</strong>
            </div>
        </div>
    @endif
    @if(session()->has('failure'))
        <div class="row">
            <div class="col-12 alert alert-danger" role="alert">
                <strong>{{session()->get('failure')}}</strong>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class = "pull-left">
                        <form cclass="navbar-form">
                            <span class="bmd-form-group">
                                <div class="input-group no-border">
                                    <button class = "btn btn-white btn-round btn-just-icon fa fa-search"></button>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Item Here"/>
                                </div>
                            </span>
                        </form>
                    </div>
                  <!--  <div class="pull-right new-button">
                        <a href="{{action('RollController@create')}}" class="btn btn-primary"  title="Create New Roll"><i class="fa fa-plus fa-2x"></i>Create New Roll</a>
                    </div>  -->
                    <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#newitemModal"><i class="fa fa-plus fa-2x"></i>New Item</button>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="roll">
                            <thead class = "text-primary">
                                <tr>
                                    <th width="10%"></th>
                                    <th class="text-center">Item</th>
                                    <th width = "20%" class="text-center">Qty</th>
                                    <th class="text-center">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($stocklist as $s)
                                <tr>
                                    <td class="text-center">
                                        <a href="" title="Edit" class="btn btn-success btn-round"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td class="text-center">{{$s->item}}</td>
                                    <td class="text-center">{{$s->qty}}</td>
                                    <td class="text-center">{{$s->location}}</td>
                                    <td>
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

<div class="modal fade" id="newitemModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Item Roll</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!!Form::open(array('action' => ['StockController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">

                       <label class="label-control">Item</label>
                            <div class='form-group'>
                            <div class="input-group">
                                <input type="text" class="form-control" name="item">
                            </div>
                            </div>
                        <label class="label-control">Qty</label>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="qty">
                        </div>
                        </div>

                        <label class="label-control">Cost</label>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="cost">
                        </div>
                        </div>
                        <label class="label-control">Location</label>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="location">
                        </div>
                        </div>
                    </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-round">Add Item</button>
            </div>
            {!!Form::close()!!}
          </div>
        </div>
    </div>
</div>
@endsection


@section ('scripts')

<script>
   // Write on keyup event of keyword input element
   $(document).ready(function(){
     $("#search").keyup(function(){
     _this = this;

     // Show only matching TR, hide rest of them
     $.each($("#roll tbody tr"), function() {
       if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
       {
           $(this).hide();
       }
       else
       {
          $(this).show();
       }
     });
  });
});
</script>



@stop
