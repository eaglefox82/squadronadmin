@extends('layouts.report')

@section('content')
   <h2 class="text-center">Camp Accounting Report</h2>


   <h3>Total Income = ${{number_format((float)$totalIncome, 2)}}</h3>
   <h3>Total Expense = ${{number_format((float)$totalExpenses, 2)}}</h3>


<h4>Expense Listing:</h4>

<div class="table-responsive">
    <table border="1" class="table" align="center">
        <thead class="text-primary">
          <tr>
            <th>Date</th>
            <th>Details</th>
            <th class="text-center">Submitted By</th>
            <th class="text-center">Amount</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $e)
                <tr>
                    <td>
                        {{date('j/n/Y', strtotime($e->expenseDate))}}
                    </td>
                    <td>{{$e->details}}</td>
                    <td class="text-center">{{$e->submittedName}}</td>
                    <td class="text-center">${{$e->amount}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="clear: both;">
    </div>
</div>
@endsection
