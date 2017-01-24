@extends('layouts.admin')

@section('title')
    Home
@endsection

@section('page-header')
    Home
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Info
                </div>
                <div class="panel-body">
                    <p>This is a basic setup for Laravel 5.3 and SB Admin 2</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Home
                </div>
                <div class="panel-body">
                    <p>The Home Page is where you can put the DashBoard Content of Your Application</p>
                </div>
            </div>
        </div>
    </div>
@endsection
