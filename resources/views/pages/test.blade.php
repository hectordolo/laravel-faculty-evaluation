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

    @foreach($test as $v)
        @foreach($v->evaluation_data as $c)
            {{$c->area_name}}
        @endforeach
    @endforeach

@endsection