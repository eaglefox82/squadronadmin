@extends('layouts.app')

@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <h3>Roll Date:</h3>
                <tr>
                    <th class="text-center">Member</th>
                    <th class="text-center">Rank</th>
                    <th class="text-center">Present</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"> </td>
                    <td class="text-center"> </td>
                    <td class="text-center"></td>
                   <!-- <td class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-info btn-round">
                            <i class="Material-icons">edit</i>
                        </button>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection