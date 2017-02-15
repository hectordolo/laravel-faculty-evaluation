@extends('layouts.admin')

@section('title')
    User Roles
@endsection

@section('page-header')
    User Roles Lists
@endsection

@section('page-content')

   <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                {!! Form::open(['route' => ['has_roles.update',$user->id], 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    <div class="form-group">
                        <ul class="legend list-unstyled">
                            @foreach($roles as $role)
                                <li>
                                    <p>
                                        <input type="checkbox" class="flat" name="roles[]" {{(in_array($role->id,$selected)?'checked':'')}} value="{{$role->id}}"/> {{$role->display_name}}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('users.index')}}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
