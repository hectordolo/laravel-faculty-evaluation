@extends('layouts.admin')

@section('title')
    List of Department Heads
@endsection

@section('page-header')
    List of Department Heads
@endsection

@section('page-content')

    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        {!! Form::open(['method' => 'GET', 'route' => 'deans_reports.search']) !!}
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
                        <th class="column-title" style="width: 15%">Dean ID</th>
                        <th class="column-title">Last Name</th>
                        <th class="column-title">First Name</th>
                        <th class="column-title" style="width: 5%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($heads as $key=>$head)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$head->sjc_id}}</td>
                                <td>{{$head->last_name}}</td>
                                <td>{{$head->first_name}}</td>
                                <td>
                                    <a href="{{route('deans_reports.view', [$head->id])}}" title="View Results" class="btn btn-default btn-sm"><i class="fa fa-list"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Showing {{ $heads->firstItem() }} to {{ $heads->lastItem() }} of {{ $heads->total() }} entries
                    <span class="pull-right">{!! $heads->setPath('')->appends(Input::query())->render() !!}</span>
                </div>
            </div>
        </div>
    </div>

@endsection