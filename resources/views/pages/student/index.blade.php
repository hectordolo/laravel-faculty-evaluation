@extends('layouts.admin')

@section('title')
    Student's Subjects List with Faculty
@endsection

@section('page-header')
    Student's Subjects List with Faculty
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
                        <th class="column-title">Faculty Name</th>
                        <th class="column-title">Subject</th>
                        <th class="column-title">Section</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($faculties as $key=>$faculty)
                        @if($faculty->faculty == 'No')
                            <tr class="danger">
                                <td>{{$key+1}}</td>
                                <td></td>
                                <td>[FACULTY NOT ENCODED]</td>
                                <td class=" ">{{isset($faculty->subject_code)?$faculty->subject_code:''}}</td>
                                <td class=" ">{{isset($faculty->section_code)?$faculty->section_code:''}}</td>
                                <td>
                                    @if($faculty->status==0)
                                        <a href="{{route('faculty.evaluate', [$faculty->migration_record_id])}}" title="Evaluate" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                    @else
                                        [EVALUATED]
                                    @endif</td>
                            </tr>
                        @else
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class=" ">{{isset($faculty->sjc_id)?$faculty->sjc_id:''}}</td>
                                <td class=" ">{{isset($faculty->employee_name)?$faculty->employee_name:''}}</td>
                                <td class=" ">{{isset($faculty->subject_code)?$faculty->subject_code:''}}</td>
                                <td class=" ">{{isset($faculty->section_code)?$faculty->section_code:''}}</td>
                                <td>
                                    @if($faculty->status==0)
                                        <a href="{{route('faculty.evaluate', [$faculty->migration_record_id])}}" title="Evaluate" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                    @else
                                        [EVALUATED]
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection