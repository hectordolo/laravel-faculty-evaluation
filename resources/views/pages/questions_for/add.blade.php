@extends('layouts.admin')

@section('title')
    Add Question For
@endsection

@section('page-header')
    Add Question For Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::open(['route' => 'for.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.questions_for.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection