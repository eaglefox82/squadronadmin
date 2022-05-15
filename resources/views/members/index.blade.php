@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Members On Roll<br><br></p>
                        <h3 class="card-title">{{$members->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-male fa-2x"></i>
                        </div>
                        <p class="card-category">Male Members<br>{{number_format(($malemembers->count()/($members->count()))*100,2)}}%<br></p>
                        <h3 class="card-title">{{$malemembers->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-female fa-2x"></i>
                        </div>
                        <p class="card-category">Female Members<br>{{number_format(($femalemembers->count()/($members->count()))*100,2)}}%<br></p>
                        <h3 class="card-title">{{$femalemembers->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>



        </div>


        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#addmemberModal" class="btn btn-primary btn-round" title="Add Member"><i class="fa fa-plus fa-2x"></i> Add Member</button>
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose pull-center">
                        <h2 class="card-title text-center">Members</h2>
                    </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-no-boreded table-hover" width="100%" id="member-table">
                                <thead class="text-primary">
                                    <th class="text-center">Membership Number</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Rank</th>
                                    <th class="text-center">Account Balance</th>
                                    <th class="text-center">Sub Owing</th>
                                    <th class="text-center">Attendance Warning</th>
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

    <div class="modal fade" id="addmemberModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class ="modal-title" id="addmemberModal">Add Member</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Form::open(array('action' => ['MembersController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
                <div class="modal-body">
                            <label class="label-control">Membership Number:</label>
                            <div class="input-group">
                                <input type = "text" class = "form-control" name = "membership" value="">
                            </div>

                            <label class="label-control">First Name:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="firstname" value="">
                            </div>

                            <label class="label-control">Last Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="lastname" value="">
                            </div>

                            <label class="label-control">Rank:</label>
                            <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="rank" data-size="6">
                                    @foreach ($rank as $r)
                                    <option value ={{$r->id}} >{{$r->rank}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <label class="label-control">Date of Joining:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="doj" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                    </div>
                                </div>

                            <label class ="label-control">Date of Birth:</label>
                                <div class ="form-group">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="dob" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                    </div>
                                </div>

                            <label class="label-control">Membership Type</label>
                           <div class="input-group">
                                <select type="text" class="selectpicker" data-sytle="select-with-transition" name="type">
                                    <option value="League">League Member</option>
                                    <option value="Associate">Associate Member</option>
                                </select>
                           </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-round btn-primary">Save Changes</button>
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

        var table=$('#member-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            ajax: '{{ route('getMemberlist') }}',
            columns: [
                { data: 'membership_number'},
                { data: 'first_name'},
                { data: 'last_name'},
                { data: 'memberrank.rank'},
                { data: 'account', render: $.fn.dataTable.render.number(',', '.', 2, '$')},
                { data: 'owning', render: $.fn.dataTable.render.number(',', '.', 2, '$')},
                { data: 'attendance'},
                { data: 'action', orderable: false, searchable: false}
            ],
            "rowCallback": function( row, data, index ) {
               if ( data.owning > 0) {
                   $('td', row).css('background-color', '#d909d2');
                    $('td', row).css('color', 'white');
                }
                if ( data.attendance == 'Yes') {
                   $('td', row).css('background-color', '#d4001c');
                    $('td', row).css('color', 'white');
                }


            }


        });
    })

</script>


@stop

