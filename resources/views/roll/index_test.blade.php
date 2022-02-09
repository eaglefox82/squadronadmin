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
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Roll Here" autofocus/>
                                </div>
                            </span>
                        </form>
                    </div>
                  <!--  <div class="pull-right new-button">
                        <a href="{{action('RollController@create')}}" class="btn btn-primary"  title="Create New Roll"><i class="fa fa-plus fa-2x"></i>Create New Roll</a>
                    </div>  -->
                    <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#newrollModal"><i class="fa fa-plus fa-2x"></i>New Roll</button>
                    <a href="{{action('RollController@parade')}}" class="btn btn-round btn-info pull-right"><i class="fa fa-book fa-2x"></i>First Parade Roll</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-no-boreded table-hover" width="100%" id="roll-table">
                            <thead class = "text-primary">
                            <h4> Roll Date: {{date("l - jS F Y",strtotime($rolldate))}}</h4>
                                <tr>
                                    <th width="20%"></th>
                                    <th class="text-center">Membership Number</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-center">Account Balance</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

@section ('scripts')
<script>
    $(function() {

        var table=$('#roll-table').DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('getCurrentRoll') }}',
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25%"},
                { data: 'member.membership_number'},
                { data: 'member.first_name'},
                { data: 'member.last_name'},
                { data: 'rollstatus.status'},
                { data: 'account', render: $.fn.dataTable.render.number(',', '.', 2, '$')},

            ],
        });
    })

</script>


@stop


