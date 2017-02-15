@extends('layouts.admin')

@section('title')
    Rating Details
@endsection

@section('page-header')
    {{$detail[0]['title']}}
    <a href="{{ route('faculty_reports.view',$faculty->id) }}" type="button" class="btn btn-sm btn-success no-print">Go Back</a>
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Ratings By Section and Subject
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">Section Code</th>
                                    <th class="column-title">Subject Code</th>
                                    <th class="column-title"style="width: 15%">Total Students</th>
                                    <th class="column-title"style="width: 15%">Done Evaluating</th>
                                    <th class="column-title"style="width: 15%">Total Rating</th>
                                    <th class="column-title"style="width: 15%">Average Rating</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($average_details as $ad)
                                    <tr>
                                        <td>{{$ad->section_code}}</td>
                                        <td>{{$ad->subject_code}}</td>
                                        <td>{{$ad->total_students}}</td>
                                        <td>{{$ad->done_evaluation}}</td>
                                        <td>{{$ad->total_rating}}</td>
                                        <td>{{$ad->average_rating}}</td>
                                    </tr>
                                @endforeach
                                    <tr class="headings">
                                        <th colspan="4"></th>
                                        <th>Average Rating</th>
                                        <th>{{$average}}</th>
                                    </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>

@endsection