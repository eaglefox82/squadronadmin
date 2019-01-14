@extends('layouts.app')

@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Setting</th>
                    <th class="text-center">Value</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"> </td>
                    <td class="text-center"> </td>
                    <td class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-info btn-round">
                            <i class="Material-icons">edit</i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection