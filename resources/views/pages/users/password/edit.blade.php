@extends('layouts.admin')

@section('title')
    Change Password
@endsection

@section('page-header')
    Change Password
@endsection

@section('page-content')

    <div class="row">
            <div class="col-lg-6">
                {!! Form::open(['method' => 'PATCH', 'route' => ['password.update'], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="col-lg-6">

                            <label for="current_password">Current Password:</label>
                            {!! Form::password('current_password', ['class' => 'form-control']) !!}

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">

                            <label for="password">Password:</label>
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">

                        <label for="password_confirmation">Confirm Password:</label>
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <br>
                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-9 col-xs-12 col-md-offset-0">
                            <a href="{{url('/')}}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
    </div>

@endsection
