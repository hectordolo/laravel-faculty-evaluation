@extends('layouts.admin')

@section('title')
    Test Page
@endsection

@section('page-header')
    Test Page
@endsection

@section('header-scripts')



@endsection

@section('page-content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">

    @foreach($data as $v)
        <tr>
            <th>
                {{$v->user_id}}
            </th>
            <th>
                {{$v->semester}}
            </th>
            <th>
                {{$v->school_year}}
            </th>
            <th>
                {{$v->subject_code}}
            </th>
            <th>
                {{$v->section_code}}
            </th>
            <th>
                {{$v->employee_id}}
            </th>
        </tr>
        @foreach($v->trait_score as $key=>$d)
            <tr>
                <th>

                </th>
                <th>

                </th>
                <th>

                </th>
                <th>
                    {{$d->area_id}}
                </th>
                <th>
                    {{$d->trait_id}}
                </th>
                <th>
                    {{$d->trait_score}}
                </th>
            </tr>
        @endforeach
    @endforeach
    </table>
    </div>

@endsection