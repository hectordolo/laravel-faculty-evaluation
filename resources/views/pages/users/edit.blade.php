@extends('layouts.app')

@section('title')
    Edit User
@endsection

@section('page-header')
    Edit User
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit User Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->id], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    @include('pages.users.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
