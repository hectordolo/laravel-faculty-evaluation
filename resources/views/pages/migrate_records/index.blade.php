@extends('layouts.admin')

@section('title')
    Migrate Records Settings
@endsection

@section('page-header')
    Migrate Records Settings
@endsection

@section('header-scripts')

    <style type="text/css">
        .uploading{
            display: none;
        }

        .deleting{
            display: none;
        }

        .padding{
            padding:0;
            margin:0;
        }
    </style>

    <script type="text/javascript">
        function uploading(i){

            var v = i;

            document.getElementById("uploading_img"+v).style.display = "inline";
            document.getElementById("uploading_text"+v).style.display = "inline";
            document.getElementById("status"+v).style.display = "none";
        }
        function deleting(i){

            var v = i;

            document.getElementById("deleting_img"+v).style.display = "inline";
            document.getElementById("deleting_text"+v).style.display = "inline";
        }

    </script>

@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title">Records Name</th>
                        <th class="column-title">Status</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td class=" ">{{$key+1}}</td>
                            <td class=" ">{{isset($record->name)?$record->name:''}}</td>
                            <td class=" ">
                                <div id="status{{$record->id}}">{{$record->status==0?'Not Migrated':'Migrated'}}</div>
                                <img src="img/ajax-loader.gif" alt="Loading" height="20" class="uploading" id="uploading_img{{$record->id}}"> <span class="uploading" id="uploading_text{{$record->id}}">migrating...</span>
                            </td>
                            <td>
                                @if($record->status==0)
                                    <a href="{{route('migrate_options.migrate', [$record->id])}}" title="Migrate Records" class="btn btn-default btn-sm" onclick="uploading({{$record->id}})"><i class="fa fa-plus"></i></a>
                                @endif
                                @if($record->status==1)
                                    <a type="button" class="btn btn-default btn-sm" title="Delete Records" data-toggle="modal" data-target="#deleteModal{{ $record->id }}"><i class="fa fa-trash"></i></a>
                                    <div id="deleteModal{{ $record->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete the records of: {{$record->name}}?</p>

                                                    <img src="img/ajax-loader.gif" alt="Loading" height="20" class="deleting" id="deleting_img{{$record->id}}"> <span class="deleting" id="deleting_text{{$record->id}}">deleting...</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <a type="button" href="{{route('migrate_options.delete', [$record->id])}}" class="btn btn-success btn-flat" onclick="deleting({{$record->id}})">Yes</a>
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
    </div>

@endsection