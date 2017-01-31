@extends('layouts.admin')

@section('title')
    Evaluation Form
@endsection

@section('page-header')
    Evaluation Form
@endsection

@section('page-content')
    {!! Form::open(['route' => 'faculty.store', 'class' => '', 'data-parsley-validate']) !!}
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        EVALUATION INFORMATION
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="employee_name">Employee Name:</label>
                                <input class="form-control" name="employee_name" id="employee_name" type="text" value="{{$faculty->last_name}}, {{$faculty->first_name}}" disabled>
                                <input class="form-control" name="sjc_id" type="hidden" value="{{$faculty->sjc_id}}">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="semester">Semester:</label>
                                <input class="form-control" id="semester" type="text" value="{{$semester->value}}" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="school_year">School Year:</label>
                                <input class="form-control" id="school_year" type="text" value="{{$school_year->value}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="evaluation_date">Date of Evaluation:</label>
                                <input class="form-control" id="evaluation_date" type="text" value="{{$time}}" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="subject_code">Subject Code:</label>
                                <input class="form-control" id="subject_code" type="text" value="{{$subject_code}}" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="section_code">Section Code:</label>
                                <input class="form-control" id="section_code" type="text" value="{{$section_code}}" disabled>
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
                        @foreach($questions as $question)
                            <h4>{{$question->area}}</h4>
                            <ol>
                                @foreach($question->questions as $v)
                                    <li>{{$v->question->name}}{{$v->question->id}}</li>
                                @endforeach
                            </ol>
                        @endforeach

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-10">
                                <a href="{{ route('faculty.index',[$faculty->id,$subject_code,$section_code]) }}" type="button" class="btn btn-primary">Cancel</a>
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}


@endsection