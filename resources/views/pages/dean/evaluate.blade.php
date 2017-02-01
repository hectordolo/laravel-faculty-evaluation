@extends('layouts.admin')

@section('title')
    Evaluation Form
@endsection

@section('page-header')
    Evaluation Form
@endsection

@section('header-scripts')
    <style type="text/css">
        .table td.center, .table th.center{
            text-align: center;
        }
    </style>
@endsection

@section('page-content')
    {!! Form::open(['route' => ['deans.store',$department_head->id], 'class' => '', 'data-parsley-validate']) !!}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    EVALUATION INFORMATION
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="employee_name">Faculty Name:</label>
                            <input class="form-control" name="employee_name" id="employee_name" type="text" value="{{isset($dean->last_name)?$dean->last_name.', '.$dean->first_name:'FACULTY NOT ENCODED'}}" disabled>
                            <input class="form-control" name="sjc_id" type="hidden" value="{{isset($dean->dean_id)?$dean->dean_id:''}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="semester">Semester:</label>
                            <input class="form-control" id="semester" type="text" value="{{$semester->value}}" disabled>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="school_year">School Year:</label>
                            <input class="form-control" id="school_year" type="text" value="{{$school_year->value}}" disabled>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="evaluation_date">Date of Evaluation:</label>
                            <input class="form-control" id="evaluation_date" type="text" value="{{$time}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    GUIDELINES
                </div>
                <div class="panel-body">
                    <p><strong>1.</strong> As a formative evaluation of the performance of the dean, please rate the following criteria in 5 point Likert Scale, <strong>5 being highly effective and 1 as not effective</strong>.</p>
                    <p><strong>2.</strong> Please feel free to write your comments & suggestions. Thank you for your cooperation.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    AREAS AND CORRESPONDING TRAITS
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            @foreach($questions as $question)
                                <tr class="success">
                                    <th colspan="7">
                                        {{$question->area}} ({{$question->percentage}}%)
                                    </th>
                                    <th style="width: 5%" class="center">1</th>
                                    <th style="width: 5%" class="center">2</th>
                                    <th style="width: 5%" class="center">3</th>
                                    <th style="width: 5%" class="center">4</th>
                                    <th style="width: 5%" class="center">5</th>
                                </tr>
                                @foreach($question->questions as $key=>$v)
                                    <tr>
                                        <td colspan="1">{{$key+1}}</td>
                                        <td colspan="6">
                                            <input class="form-control" name="trait_id[{{$v->question->id}}]" type="hidden" value="{{$v->question->id}}">
                                            <input class="form-control" name="area_id[{{$v->question->id}}]" type="hidden" value="{{$question->area_id}}">
                                            {{$v->question->name}}
                                        </td>
                                        <td class="center"><input type='radio' value="1.00" name="trait_score[{{$v->question->id}}]" required="required"></td>
                                        <td class="center"><input type='radio' value="2.00" name="trait_score[{{$v->question->id}}]" required="required"></td>
                                        <td class="center"><input type='radio' value="3.00" name="trait_score[{{$v->question->id}}]" required="required"></td>
                                        <td class="center"><input type='radio' value="4.00" name="trait_score[{{$v->question->id}}]" required="required"></td>
                                        <td class="center"><input type='radio' value="5.00" name="trait_score[{{$v->question->id}}]" required="required"></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>

                    <div class="form-group">
                        <label>Comments (Optional):</label>
                        <textarea name="comments" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-10">
                            <a href="{{ route('deans.index') }}" type="button" class="btn btn-primary">Cancel</a>
                            <a type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-success">Save</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Submit</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit your evaluation of the faculty?</p>
                    <p><strong>This cannot be undone!</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    {!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection