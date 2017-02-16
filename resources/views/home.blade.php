@extends('layouts.admin')

@section('title')
    Home
@endsection

@section('page-header')
    <i class="fa fa-heart fa-xs"></i> Happy Hearts Month! {{$auth_user->first_name}}! <i class="fa fa-heart fa-xs"></i>
@endsection

@section('page-content')

    @role('student')
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        SJC Faculty Evaluation
                    </div>
                    <div class="panel-body">
                        <p>For us to be able to continue to provide you and other students quality education we would like you to give us honest feedback on how our faculty perform.</p>
                        <p>Thank you for your time.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
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
        </div>
        <div class="row">
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
        </div>
    @endrole

    @role(['faculty','dean','vpaa'])
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        SJC Dean Evaluation
                    </div>
                    <div class="panel-body">
                        <p>Hello <strong>{{$auth_user->last_name.', '.$auth_user->first_name}}!</strong></p>
                        <p>This is an application where you can evaluate the performance of the OIC in your department such as the Deans, Principal, Coordinator and the like</p>
                    </div>
                </div>
            </div>
        </div>
    @endrole
    
    @role('reports')
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        Viewing of Reports: Warning!
                    </div>
                    <div class="panel-body">
                        <p>You have the access to the viewing the result of the evaluation of faculty and deans. All the reports and information are confidential please be guided.</p>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection
