@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class = "row">
            <div class="col-sm-6">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h3 class ="card-title text-center"><strong>Form 19's</strong></h3>
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class = "card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Month</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Report Name</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($form19 as $f)
                                        <tr>
                                            <td class="text-center">{{$f->month}} </td>
                                            <td class="text-center">{{$f->year}} </td>
                                            <td class="text-center">{{$f->form_name}}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{action('ReportController@downloadpast', $f->id)}}" rel="tooltip" class="btn btn-info btn-round">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

           

@endsection
