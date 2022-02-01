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
                <div class="card-body">
                    <h3 class="text-center">Points Report</h3>

                    <div class="table-responsive">
                        <table class="table table-striped table-no-boreded table-hover" width="100%" id="points-table">
                            <thead class = "text-primary">
                            <h4> </h4>
                                <tr>
                                    <th class="text-center">Rank</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Total Points</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody class = "text-center">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type = "text/javascript">
    $(function() {

        var table=$('#points-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('getPoints') }}',
            columns: [
                { data: 'rank', defaultContent: ''},
                { data: 'first_name'},
                { data: 'last_name'},
                { data: 'TotalPoints'},
            ],
                drawCallback: function () {
                api = this.api();
                var arr = api.columns(3).data()[0];  //get array of column 3 (extn)
                console.log(arr);
                var sorted = arr.slice().sort(function(a,b){return b-a});
                var ranks = arr.slice().map(function(v){ return sorted.indexOf(v)+1 });
                console.log(sorted);
                console.log(ranks);
                // interate through each row
                api.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                    var data = this.data();
                    var rank = ranks[rowLoop];
                    data.rank = ranks[arr.indexOf(data.extn)];  //set the rank column = the array index of the extn in the ranked array
             } );
        api.rows().invalidate();
        }
        });
    })

</script>



@stop
