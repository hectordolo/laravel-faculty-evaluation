@extends('layouts.admin')

@section('title')
    User Lists
@endsection

@section('page-header')
    User Lists
@endsection

@section('page-content')

    <a href="{{ route('users.add') }}" type="button" class="btn btn-sm btn-success">Add User</a>

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'users.search']) !!}
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
                            <th class="column-title">SJC ID </th>
                            <th class="column-title">Name</th>
                            <th class="column-title">School Code</th>
                            <th class="column-title">Type </th>
                            <th class="column-title">School 0f</th>
                            <th class="column-title" style="width: 15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
                                <td class=" ">{{$key+1}}</td>
                                <td class=" ">{{isset($user->sjc_id)?$user->sjc_id:''}}</td>
                                <td class=" ">{{isset($user->last_name)?$user->last_name.', ':''}}{{isset($user->first_name)?$user->first_name:''}}</td>
                                <td class=" ">{{isset($user->school_code)?$user->school_code:''}}</td>
                                <td class=" ">{{isset($user->type)?$user->type:''}}</td>
                                <td class=" ">{{isset($user->school_of)?$user->school_of:''}}</td>
                                <td>
                                    @if($user->type!='STUDENT')
                                        <a href="{{route('assign.index', [$user->id])}}" title="Choose Head" class="btn btn-default btn-sm"><i class="fa fa-male"></i></a>
                                    @endif
                                    <a href="{{route('users.edit', [$user->id])}}" title="Edit" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a type="button" class="btn btn-default btn-sm" title="Delete User" data-toggle="modal" data-target="#deleteModal{{ $user->id }}"><i class="fa fa-trash"></i></a>
                                    <div id="deleteModal{{ $user->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{isset($user->username)?'the user account:'.$user->username:'this user account'}}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                                    {!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('has_roles.edit', [$user->id])}}" title="User Roles" class="btn btn-default btn-sm"><i class="fa fa-key"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                    <span class="pull-right">{!! $users->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection
