@extends('layouts.app')

@section('title')
    User Lists
@endsection

@section('page-header')
    User Lists
@endsection

@section('page-content')

    @include('flash::message')

    <a href="{{ route('user.add') }}" type="button" class="btn btn-sm btn-success">Add User</a>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'user.search']) !!}
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
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="width: 5%">#</th>
                            <th class="column-title">Employee ID </th>
                            <th class="column-title">Username </th>
                            <th class="column-title">Name</th>
                            <th class="column-title">Email</th>
                            <th class="column-title">Position </th>
                            <th class="column-title">Department</th>
                            <th class="column-title" style="width: 15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
                                <td class=" ">{{$key+1}}</td>
                                <td class=" ">{{isset($user->employee_id)?$user->employee_id:''}}</td>
                                <td class=" ">{{isset($user->username)?$user->username:''}}</td>
                                <td class=" ">{{isset($user->lname)?$user->lname.', ':''}}{{isset($user->fname)?$user->fname:''}}</td>
                                <td class=" ">{{isset($user->email)?$user->email:''}}</td>
                                <td class=" ">{{isset($user->position)?$user->position:''}}</td>
                                <td class=" ">{{isset($user->department)?$user->department:''}}</td>
                                <td>
                                    <a href="{{route('users.roles.edit', [$user->id])}}" title="Role" class="btn btn-default btn-sm"><i class="fa fa-male"></i></a>
                                    <a href="{{route('user.edit', [$user->id])}}" title="Edit" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
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
                                                    {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete']) !!}
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
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                    <span class="pull-right">{!! $users->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection
