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

            {!! Form::model($group, ['method' => 'PATCH', 'route' => ['groups.update', $group->id], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            @include('pages.groups.form')
            {!! Form::close() !!}

        </div>
    </div>

@endsection