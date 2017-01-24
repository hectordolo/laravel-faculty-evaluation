@extends('layouts.admin')

@section('title')
    Add Groups
@endsection

@section('page-header')
    Add Group Form
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">

            {!! Form::open(['route' => 'groups.store', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.groups.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection