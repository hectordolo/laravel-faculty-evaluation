@extends('layouts.admin')

@section('title')
    Groups and Questions List
@endsection

@section('header-scripts')

    <!-- DataTables CSS -->
    <link href="{{ URL::asset('vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="{{ URL::asset('vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

@endsection

@section('page-header')
    Available Questions for the Group:{{$group->name}}
@endsection

@section('page-content')

    {!! Form::open(['route' => 'groups_questions.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-questions">
                    <thead>
                        <tr>
                            <th style="width: 5%"></th>
                            <th>Question</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($available_questions as $available_question)
                            <tr>
                                <td><input type="checkbox" name="questions_id[]" value="{{$available_question->id}}"/></td>
                                <td>{{isset($available_question->name)?$available_question->name:''}}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="ln_solid"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" name="group_id" value="{{$group->id}}" hidden/>
                        <a href="{{ route('groups_questions.index', $group->id) }}" type="button" class="btn btn-primary">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection

@section('footer-scripts')

    <!-- DataTables JavaScript -->
    <script src="{{ URL::asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/datatables-responsive/dataTables.responsive.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTables-questions').DataTable({
                responsive: true,
                pageLength: 30
            });
        });
    </script>
@endsection