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

    @foreach($data as $d)
        {{$d->student_code}}<br>
    @endforeach

@endsection