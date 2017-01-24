@extends('layouts.admin')

@section('title')
    Groups View
@endsection

@section('page-header')
    Groups View
@endsection

@section('page-content')

    <a href="{{ route('groups.add') }}" type="button" class="btn btn-sm btn-success">Add Group</a>

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'groups.search']) !!}
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
                        <th class="column-title">Group Name</th>
                        <th class="column-title" style="width: 5%">Percentage</th>
                        <th class="column-title" style="width: 5%">Priority</th>
                        <th class="column-title">Group For </th>
                        <th class="column-title" style="width: 5%">Active</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($groups as $key=>$group)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($group->name)?$group->name:''}}</td>
                            <td class=" ">{{isset($group->percentage)?$group->percentage:''}}</td>
                            <td class=" ">{{isset($group->priority)?$group->priority:''}}</td>
                            <td class=" ">{{isset($group->questions_for->name)?$group->questions_for->name:''}}</td>
                            <td class=" ">{{isset($group->active)?$group->active==1?'Yes':'No':''}}</td>
                            <td>
                                <a href="{{route('groups.edit', [$group->id])}}" title="Edit" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
                                <a type="button" class="btn btn-default btn-sm" title="Delete Group" data-toggle="modal" data-target="#deleteModal{{ $group->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $group->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete {{isset($group->name)?'the group: '.$group->name.'?':'this group?'}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
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
                    Showing {{ $groups->firstItem() }} to {{ $groups->lastItem() }} of {{ $groups->total() }} entries
                    <span class="pull-right">{!! $groups->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection