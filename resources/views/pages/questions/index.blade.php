@extends('layouts.admin')

@section('title')
    Questions View
@endsection

@section('page-header')
    Questions View
@endsection

@section('page-content')

    <a href="{{ route('questions.add') }}" type="button" class="btn btn-sm btn-success">Add Question</a>

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'questions.search']) !!}
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
                        <th class="column-title">Question</th>
                        <th class="column-title">Active</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($questions as $key=>$question)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($question->name)?$question->name:''}}</td>
                            <td class=" ">{{isset($question->active)?$question->active==1?'Yes':'No':''}}</td>
                            <td>
                                <a href="{{route('questions.edit', [$question->id])}}" title="Edit" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
                                <a type="button" class="btn btn-default btn-sm" title="Delete Question" data-toggle="modal" data-target="#deleteModal{{ $question->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $question->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete {{isset($question->name)?'the question: '.$question->name.'?':'this question?'}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'delete']) !!}
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
                    Showing {{ $questions->firstItem() }} to {{ $questions->lastItem() }} of {{ $questions->total() }} entries
                    <span class="pull-right">{!! $questions->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection