@extends('layouts.admin')

@section('title')
    Lists of Department Heads
@endsection

@section('page-header')
    Lists of Department Heads
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title">Dean ID</th>
                        <th class="column-title">Last Name</th>
                        <th class="column-title">First Name</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($heads as $key=>$head)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$head->dean->sjc_id}}</td>
                            <td>{{$head->dean->last_name}}</td>
                            <td>{{$head->dean->first_name}}</td>
                            <td>
                                @if($head->status == 0)
                                    <a href="{{route('deans.evaluate', [$head->id])}}" title="Evaluate" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                @else
                                    [EVALUATED]
                                @endif
                                 </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection