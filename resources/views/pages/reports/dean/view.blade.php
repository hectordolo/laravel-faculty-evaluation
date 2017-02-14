@extends('layouts.admin')

@section('title')
    List of Department Heads
@endsection

@section('page-header')
    {{$dean->last_name}}, {{$dean->first_name}} Evaluation Results
@endsection

@section('page-content')

    <div class="row">
        <div class="col-xs-6 col-lg-3 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$faculty_number}}</div>
                            <div>Total Faculty</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer no-print">
                        <a href="{{route('deans_reports.details', [1, $dean->id])}}">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$done_evaluating}}</div>
                            <div>Faculty Completed</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer no-print">
                        <a href="{{route('deans_reports.details', [2, $dean->id])}}">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$not_done_evaluating}}</div>
                            <div>Faculty Not Completed</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer no-print">
                        <a href="{{route('deans_reports.details', [3, $dean->id])}}">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-star fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$average[0]['average_value']}}</div>
                            <div>Average Rating</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('deans_reports.rating', [1, $dean->id])}}">
                    <div class="panel-footer no-print">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-chevron-circle-up fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$average[0]['average_highest']}}</div>
                            <div>Highest Evaluation</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-chevron-circle-down fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$average[0]['average_lowest']}}</div>
                            <div>Lowest Evaluation</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body">
                    @if(!empty($comments_data))
                        @foreach($comments_data as $key=>$value)
                            <p>{{$key+1}}. {{$value}}</p>
                        @endforeach
                    @else
                        <p>NO COMMENTS AVAILABLE</p>
                    @endif
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>

@endsection