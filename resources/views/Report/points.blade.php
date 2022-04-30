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
                    <div class="pull-right new-button">
                            <a href="{{action('ReportController@print_points')}}" class="btn btn-round btn-success pull-right"><i class="fa fa-book fa-2x"></i>Print Points</a>
                        </div>
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



<script type = "text/javascript">
    $(function() {

        var table=$('#points-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            ajax: '{{ route('getPoints') }}',
            columns: [
                { data: 'rank', defaultContent: ''},
                { data: 'first_name'},
                { data: 'last_name'},
                { data: 'TotalPoints'},
            ]
        });
    })

</script>



@stop
