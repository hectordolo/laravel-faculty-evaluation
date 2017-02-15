@extends('layouts.admin')

@section('title')
    Rating Details
@endsection

@section('page-header')
    {{$detail[0]['title']}}
    <a href="{{ route('deans_reports.view',$dean->id) }}" type="button" class="btn btn-sm btn-success no-print no-print">Go Back</a>
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">

                <div class="panel-heading">
                    Average Rating Details
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Faculty Name</th>
                                @foreach($headers as $header)
                                    <th class="column-title">{{$header->name}}</th>
                                @endforeach
                                <th class="column-title"style="width: 15%">Total Rating</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($average_details as $ad)
                                    <tr>
                                        <td>{{$ad->faculty_name}}</td>
                                        @if(empty($ad->area_ratings))
                                            <td>---</td>
                                            <td>---</td>
                                            <td>---</td>
                                            <td>---</td>
                                        @else
                                            @foreach($ad->area_ratings as $ar)
                                                @foreach($ar->evaluation_data as $v)
                                                    <td>{{$v->area_average}}</td>
                                                @endforeach
                                                    <td>{{$ar->average_rating}}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                                <tr class="headings">
                                    <th>Over All Average Rating</th>
                                        @for($i = 0 ; $i < count($headers_scores); $i++)
                                            <th>{{isset($headers_scores[$i]['header_average'])? $headers_scores[$i]['header_average']:'---'}}</th>
                                        @endfor
                                    <th>{{isset($average)?$average:''}}</th>
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