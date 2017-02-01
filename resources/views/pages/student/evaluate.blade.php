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
    {!! Form::open(['route' => ['faculty.store',$migrate_record->subject_code,$migrate_record->section_code], 'class' => '', 'data-parsley-validate']) !!}
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        EVALUATION INFORMATION
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="employee_name">Faculty Name:</label>
                                <input class="form-control" name="employee_name" id="employee_name" type="text" value="{{isset($faculty->last_name)?$faculty->last_name.', '.$faculty->first_name:'FACULTY NOT ENCODED'}}" disabled>
                                <input class="form-control" name="sjc_id" type="hidden" value="{{isset($faculty->sjc_id)?$faculty->sjc_id:''}}">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="semester">Semester:</label>
                                <input class="form-control" id="semester" type="text" value="{{$migrate_record->semester}}" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="school_year">School Year:</label>
                                <input class="form-control" id="school_year" type="text" value="{{$migrate_record->school_year}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="evaluation_date">Date of Evaluation:</label>
                                <input class="form-control" id="evaluation_date" type="text" value="{{$time}}" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="subject_code">Subject Code:</label>
                                <input class="form-control" id="subject_code" type="text" value="{{$migrate_record->subject_code}}" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="section_code">Section Code:</label>
                                <input class="form-control" id="section_code" type="text" value="{{$migrate_record->section_code}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        GUIDELINES
                    </div>
                    <div class="panel-body">
                        <p><strong>1.</strong> The teacher shall be evaluated per trait on a point-scale ranging from <strong>1 to 5</strong> corresponding to his/her performance from poor to excellent.</p>
                        <p><strong>2.</strong> Write on each blank under the score column the point/s applicable to each trait according to your observation of the teacher.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        COMPUTATION
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <ol>
                                <li>To get the SUB-TOTAL, add the points per area.</li>
                                <li>To get the AVERAGE, divide the sub-total by the corresponding number of traits per area.</li>
                                <li>To get the AREA RATING, multiply the average by the corresponding percentage weight per area.</li>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <strong>Weights:</strong>
                                    </div>
                                    <div class="col-lg-2">
                                        <strong>a. Personality = 20%</strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <strong>b. Mastery of Subject Matter = 30%</strong>
                                    </div>
                                    <div class="col-lg-2">
                                        <strong>c. Methodology = 30%</strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <strong>d. Classroom Management = 20%</strong>
                                    </div>
                                </div>
                                <li>To get the TOTAL OBSERVATION RATING, add all of the area ratings.</li>
                            </ol>
                        </div>
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
                                <a href="{{ route('faculty.index') }}" type="button" class="btn btn-primary">Cancel</a>
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