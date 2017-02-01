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

                {!! Form::open(['route' => 'users.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                @include('pages.users.form')
                {!! Form::close() !!}

        </div>
    </div>
@endsection
