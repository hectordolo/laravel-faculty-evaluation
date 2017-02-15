@extends('layouts.admin')

@section('title')
    Faculty List
@endsection

@section('page-header')
    {{$detail[0]['title']}}
    <a href="{{ route('deans_reports.view',$dean->id) }}" type="button" class="btn btn-sm btn-success no-print">Go Back</a>
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title" style="width: 15%">Faculty ID</th>
                        <th class="column-title">Last Name</th>
                        <th class="column-title">First Name</th>
                        <th class="column-title"style="width: 20%">Status</th>
                        <th class="column-title" style="width: 5%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($faculties as $key=>$faculty)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$faculty->sjc_id}}</td>
                            <td>{{$faculty->last_name}}</td>
                            <td>{{$faculty->first_name}}</td>
                            <td>
                                @if($faculty->status==0)
                                    [EVALUATION NOT DONE]
                                @else
                                    [AVERAGE RATING: {{$faculty->rating}}]
                                @endif
                            </td>
                            <td>
                                <a type="button" class="btn btn-default btn-sm" title="Delete User" data-toggle="modal" data-target="#deleteModal{{ $faculty->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $faculty->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">

                                                @if($faculty->status==1)
                                                    <p>This faculty already casted his/her evaluation?</p>
                                                    <p>This cannot be undone?</p>
                                                @endif

                                                <p>Are you sure you want to remove the faculty?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['deans_reports.destroy', $faculty->id], 'method' => 'delete']) !!}
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
        </div>
    </div>

@endsection