@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2 class="text-center">Camp Accounting</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Available Funds<br><br></p>
                        <h3 class="card-title">${{number_format((float)$availableFunds, 2)}}</h3>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money fa-2x"></i>
                        </div>
                        <p class="card-category">Camp Expenses<br><br></p>
                        <h3 class="card-title">${{number_format((float)$totalExpenses, 2)}}</h3>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-calendar fa-2x"></i>
                        </div>
                        <p class="card-category">Camp Days<br><br></p>
                        <h3 class="card-title">{{$campDays}}</h3>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <p class="card-category">$/Day Available<br><br></p>
                        <h3 class="card-title">${{number_format((float)($availableFunds / $campDays), 2)}}</h3>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">autorenew</i>
                  </div>
                  <p class="card-category">Return and Earn Income<br><br></p>
                  <h3 class="card-title">${{number_format((float)($returnEarn), 2)}}</h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="row">
                <div class="alert alert-success" role="alert">
                    <strong>{{session()->get('success')}}</strong>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title ">Camp Expenses</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right new-button">
                            <a href="{{action('AccountingController@create')}}" class="btn btn-primary" title="Add Expense"><i
                                        class="fa fa-plus fa-2x"></i> Add Expense</a>
                        </div>
                        <div class="pull-right new button">
                            <a href="{{action('AccountingController@return')}}" class="btn btn-primary" title="Add Return and Earn"><i
                                       class="fa fa-plus fa-2x"></i> Add Return and Earn</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>Date</th>
                                    <th>Details</th>
                                    <th class="text-center">Submitted By</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Pending</th>
                                    <th width="20%"></th>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $e)
                                        <tr>
                                            <td>
                                                {{date('j/n/Y', strtotime($e->expenseDate))}}
                                            </td>
                                            <td>{{$e->details}}</td>
                                            <td class="text-center">{{$e->submittedName}}</td>
                                            <td class="text-center">${{$e->amount}}</td>
                                            <td class="text-center">
                                                @if($e->pending == 0)
                                                    -
                                                @else
                                                    YES
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($e->pending == 1)
                                                    <a href="{{action('AccountingController@commitExpense', $e->id)}}" class="btn btn-success" title="Commit Expense"><i class="fa fa-check"></i></a>
                                                @endif

                                                <a href="{{action('AccountingController@edit', $e->id)}}" class="btn btn-info" title="Edit Expense"><i class="fa fa-pencil"></i></a>
                                                {!! Form::open(['method' => 'DELETE','action' => ['AccountingController@destroy', $e->id],'style'=>'display:inline']) !!}
                                                <button type="submit" class="btn btn-danger" title="Delete Expense"><i class="fa fa-trash"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="6">
                                            <br>
                                            <a href="{{ action('PDFController@expensesReport') }}" target="_blank">Expense Report (PDF)</a>
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
