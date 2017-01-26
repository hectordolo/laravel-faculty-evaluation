@extends('layouts.admin')

@section('title')
    Migrated Records View
@endsection

@section('page-header')
    Migrated Records View
@endsection

@section('header-scripts')

    <style type="text/css">
        #uploading{
            display: none;
        }

        .padding{
            padding:0;
            margin:0;
        }
    </style>

    <script type="text/javascript">
        function disable(){
            document.getElementById("upload").style.display = "none";
            document.getElementById("uploading").style.display = "block";
        }
    </script>

@endsection

@section('page-content')

    <a href="{{ route('migrate_records.migrate') }}" id="upload" type="button" class="btn btn-sm btn-success" onsubmit="disable()">Migrate Records</a>
    <img src="img/ajax-loader.gif" alt="Loading" height="20" id="uploading">

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'migrate_records.search']) !!}
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
                        <th class="column-title">Student Code</th>
                        <th class="column-title">Subject Code</th>
                        <th class="column-title">Section Code</th>
                        <th class="column-title">Faculty</th>
                        <th class="column-title" style="width: 10%">Status</th>
                        <th class="column-title" style="width: 5%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($record->student_code)?$record->student_code:''}}</td>
                            <td class=" ">{{isset($record->subject_code)?$record->subject_code:''}}</td>
                            <td class=" ">{{isset($record->section_code)?$record->section_code:''}}</td>
                            <td class=" ">{{isset($record->employee_code)?$record->employee_code:''}}</td>
                            <td class=" ">{{$record->status==0?'Not Evaluated':'Evaluated'}}</td>
                            <td>
                                <a type="button" class="btn btn-default btn-sm" title="Delete Group" data-toggle="modal" data-target="#deleteModal{{ $record->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $record->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this record?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['migrate_records.destroy', $record->id], 'method' => 'delete']) !!}
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
                    Showing {{ $records->firstItem() }} to {{ $records->lastItem() }} of {{ $records->total() }} entries
                    <span class="pull-right">{!! $records->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection