@extends('layouts.admin')

@section('title')
    Edit User
@endsection

@section('page-header')
    Edit User Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                @include('pages.users.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection
