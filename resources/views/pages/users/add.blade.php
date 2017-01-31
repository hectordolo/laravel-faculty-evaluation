@extends('layouts.admin')

@section('title')
    Add Users
@endsection

@section('page-header')
    Add Users
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add User Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    @include('pages.users.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
