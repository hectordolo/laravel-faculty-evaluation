@extends('layouts.admin')

@section('title')
    Groups and Questions List
@endsection

@section('page-header')
    {{$group->name}}'s Questions List
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('groups.index') }}" type="button" class="btn btn-sm btn-primary">Cancel</a>
            <a href="{{ route('groups_questions.add', $group->id) }}" type="button" class="btn btn-sm btn-success">Add Questions To Group</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title">Question</th>
                        <th class="column-title">Priority</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($groups_questions as $key=>$groups_question)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($groups_question->question->name)?$groups_question->question->name:''}}</td>
                            <td class=" ">{{isset($groups_question->priority)?$groups_question->priority:''}}</td>
                            <td>
                                <a type="button" class="btn btn-default btn-sm" title="Delete Question For" data-toggle="modal" data-target="#deleteModal{{ $groups_question->id }}"><i class="fa fa-trash"></i></a>
                                <div id="deleteModal{{ $groups_question->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Confirm Delete</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to remove {{isset($groups_question->question->name)?'the question: '.$groups_question->question->name.'from the group'.$group->name:'this question'}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                {!! Form::open(['route' => ['groups_questions.destroy', $groups_question->id], 'method' => 'delete']) !!}
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
                    Showing {{ $groups_questions->firstItem() }} to {{ $groups_questions->lastItem() }} of {{ $groups_questions->total() }} entries
                    <span class="pull-right">{!! $groups_questions->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection