@extends('layouts.admin')

@section('title')
    Faculty Evaluation
@endsection

@section('page-header')
    Faculty Evaluation
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title">Faculty ID</th>
                        <th class="column-title">Faculty Name</th>
                        <th class="column-title">Subject</th>
                        <th class="column-title">Section</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    {{$auth_user}}
                    @foreach($faculties as $key=>$faculty)
                        <tr>
                            <td class=" ">{{isset($faculty->sjc_id)?$faculty->sjc_id:''}}</td>
                            <td class=" ">{{isset($faculty->name)?$faculty->name:''}}</td>
                            <td class=" ">{{isset($faculty->subject_code)?$faculty->subject_code:''}}</td>
                            <td class=" ">{{isset($faculty->section_code)?$faculty->section_code:''}}</td>
                            <td>
                                <a href="{{route('faculty.evaluate', [$faculty->sjc_id])}}" title="Evaluate" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection