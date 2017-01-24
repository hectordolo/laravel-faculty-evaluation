@extends('layouts.admin')

@section('title')
    Global Variables View
@endsection

@section('page-header')
    Global Variables View
@endsection

@section('page-content')

    <a href="{{ route('global_variables.add') }}" type="button" class="btn btn-sm btn-success">Add Variable</a>

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'global_variables.search']) !!}
        <div class="input-group">
            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for...']) !!}
            <span class="input-group-btn">
                        {!! Form::button('Go!', ['class' => 'btn btn-default', 'type' => 'submit']) !!}
                        </span>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title">Name</th>
                        <th class="column-title">Value</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($global_variables as $key=>$global_variable)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($global_variable->name)?$global_variable->name:''}}</td>
                            <td class=" ">{{isset($global_variable->value)?$global_variable->value:''}}</td>
                            <td>
                                <a href="{{route('global_variables.edit', [$global_variable->id])}}" title="Edit" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
                                <a type="button" class="btn btn-default btn-sm" title="Delete Global Variable" data-toggle="modal" data-target="#deleteModal{{ $global_variable->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $global_variable->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete {{isset($global_variable->name)?'the global variable: '.$global_variable->name.'?':'this group?'}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['global_variables.destroy', $global_variable->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    Showing {{ $global_variables->firstItem() }} to {{ $global_variables->lastItem() }} of {{ $global_variables->total() }} entries
                    <span class="pull-right">{!! $global_variables->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection