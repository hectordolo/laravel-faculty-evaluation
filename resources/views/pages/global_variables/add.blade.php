@extends('layouts.admin')

@section('title')
    Global Variables
@endsection

@section('page-header')
    Global Variables Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::open(['route' => 'global_variables.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.global_variables.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection