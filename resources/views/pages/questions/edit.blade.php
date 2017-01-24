@extends('layouts.admin')

@section('title')
    Edit Question
@endsection

@section('page-header')
    Edit Question Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::model($question, ['method' => 'PATCH', 'route' => ['questions.update', $question->id], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.questions.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection