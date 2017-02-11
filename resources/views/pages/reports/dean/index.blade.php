@extends('layouts.admin')

@section('title')
    List of Department Heads
@endsection

@section('page-header')
    List of Department Heads
@endsection

@section('page-content')

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
                                <td>{{$head->user->sjc_id}}</td>
                                <td>{{$head->user->last_name}}</td>
                                <td>{{$head->user->first_name}}</td>
                                <td>
                                    <a href="{{route('deans_reports.view', [$head->user->id])}}" title="View Results" class="btn btn-default btn-sm"><i class="fa fa-list"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection