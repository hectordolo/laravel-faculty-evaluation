@extends('layouts.admin')

@section('title')
    Dean Evaluation
@endsection

@section('page-header')
    Dean Evaluation
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title">Name of Dean</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($deans as $key=>$dean)
                        <tr>
                            <td class=" ">{{isset($dean->last_name)?$dean->last_name.', '.$dean->first_name:''}}</td>
                            <td>
                                @if($dean->status == 0)
                                    <a href="{{route('deans.evaluate', [$dean->department_head_id])}}" title="Evaluate" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
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