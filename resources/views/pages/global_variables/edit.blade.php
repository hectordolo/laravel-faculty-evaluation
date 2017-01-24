@extends('layouts.admin')

@section('title')
    Edit Group
@endsection

@section('page-header')
    Edit Group Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::model($global_variable, ['method' => 'PATCH', 'route' => ['global_variables.update', $global_variable->id], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.global_variables.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection