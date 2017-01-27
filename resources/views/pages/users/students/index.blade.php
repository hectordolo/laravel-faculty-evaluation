@extends('layouts.admin')

@section('title')
    Students View
@endsection

@section('page-header')
    Students View
@endsection

@section('page-content')

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'students.search']) !!}
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
                        <th class="column-title">Student ID</th>
                        <th class="column-title">Last Name</th>
                        <th class="column-title">First Name</th>
                        <th class="column-title">School Code</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($students as $key=>$student)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($student->student_id)?$student->student_id:''}}</td>
                            <td class=" ">{{isset($student->last_name)?$student->last_name:''}}</td>
                            <td class=" ">{{isset($student->first_name)?$student->first_name:''}}</td>
                            <td class=" ">{{isset($student->school_code)?$student->school_code:''}}</td>
                            <td>
                                <a type="button" class="btn btn-default btn-sm" title="Delete Question" data-toggle="modal" data-target="#deleteModal{{ $student->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $student->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete {{isset($employee->username)?'the user with username: '.$employee->username.'?':'this user?'}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
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
                    Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
                    <span class="pull-right">{!! $employees->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection