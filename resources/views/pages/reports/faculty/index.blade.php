@extends('layouts.admin')

@section('title')
    List of Faculty
@endsection

@section('page-header')
    List of Faculty
@endsection

@section('page-content')

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'faculty_reports.search']) !!}
        <div class="input-group">
            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for...']) !!}
            <span class="input-group-btn">
                        {!! Form::button('Go!', ['class' => 'btn btn-default', 'type' => 'submit']) !!}
                        </span>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title" style="width: 15%">Faculty ID</th>
                        <th class="column-title">Last Name</th>
                        <th class="column-title">First Name</th>
                        <th class="column-title">School</th>
                        <th class="column-title">College</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($faculties as $key=>$faculty)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$faculty->sjc_id}}</td>
                                <td>{{$faculty->last_name}}</td>
                                <td>{{$faculty->first_name}}</td>
                                <td>{{$faculty->school_code}}</td>
                                <td>{{$faculty->school_of}}</td>
                                <td>
                                    <a href="{{route('faculty_reports.view', [$faculty->id])}}" title="View Results" class="btn btn-default btn-sm"><i class="fa fa-list"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    Showing {{ $faculties->firstItem() }} to {{ $faculties->lastItem() }} of {{ $faculties->total() }} entries
                    <span class="pull-right">{!! $faculties->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection