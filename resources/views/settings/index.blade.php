@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class = "row">
            <div class="col-sm-6">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h3 class ="card-title text-center"><strong>Settings</strong></h3>
                        <button href="" type="button" name="Add Setting" class="btn btn-success btn-round pull-right">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class = "card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Setting</th>
                                    <th class="text-center">Value</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $s)
                                        <tr>
                                            <td class="text-center">{{$s->setting}} </td>
                                            <td class="text-center">{{$s->value}} </td>
                                            <td class="td-actions text-right">
                                                <a href="{{action('SettingsController@edit', $s->id)}}" type="button" rel="tooltip" class="btn btn-info btn-round">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h3 class ="card-title text-center"><strong>Other Items</strong></h3>
                        <a href="{{action('OtheritemsController@create')}}" type="button" name="Add Item" class="btn btn-success btn-round pull-right">
                             <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class = "card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th class="text-center">Item</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($otheritems as $o)
                                        <tr>
                                            <td class="text-center">{{$o->item}} </td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" class="btn btn-info btn-round">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </td>
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
@endsection