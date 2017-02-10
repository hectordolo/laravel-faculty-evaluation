@extends('layouts.admin')

@section('title')
    Choose Head
@endsection

@section('page-header')
    Choose Department Head
@endsection

@section('page-content')


        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="width: 5%">#</th>
                            <th class="column-title">Employee ID</th>
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
                                    @if(!in_array($head->user->id,$selected))
                                        <a href="{{route('assign.store', [$user, $head->user->id])}}" title="Add Head" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></a>
                                    @else
                                        <a type="button" class="btn btn-default btn-sm" title="Delete Records" data-toggle="modal" data-target="#deleteModal{{ $head->user->id }}"><i class="fa fa-trash"></i></a>
                                        <div id="deleteModal{{ $head->user->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Confirm Delete</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove department Head?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        <a type="button" href="{{route('assign.delete', [$user, $head->user->id])}}" class="btn btn-success btn-flat">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

@endsection
