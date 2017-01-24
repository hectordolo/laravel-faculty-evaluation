@extends('layouts.admin')

@section('title')
    Add Question
@endsection

@section('page-header')
    Add Question Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::open(['route' => 'questions.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.questions.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection