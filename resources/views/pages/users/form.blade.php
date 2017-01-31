<div class="row">
    <div class="col-lg-4 form-group">
        <label for="lname">Last Name:</label>
        {!! Form::text('lname', null, ['class' => 'form-control', 'id' => 'lname']) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label for="fname">First Name:</label>
        {!! Form::text('fname', null, ['class' => 'form-control', 'id' => 'fname']) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label for="employee_id">Employee ID:</label>
        {!! Form::text('employee_id', null, ['class' => 'form-control', 'id' => 'employee_id']) !!}
    </div>
</div>


<div class="row">
    <div class="col-lg-4 form-group">
        <label for="username">Username:</label>
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label for="password">Password:</label>
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="col-lg-4 form-group">
        <label for="password_confirmation">Confirm Password:</label>
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-4 form-group">
        <label for="email">Email Address:</label>
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label for="position">Position:</label>
        {!! Form::select('position', $positions,null , ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label for="department">Department:</label>
        {!! Form::select('department',$departments ,null , ['class' => 'form-control']) !!}
    </div>
</div>


<div class="ln_solid"></div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <a href="{{ route('users.index') }}" type="button" class="btn btn-primary">Cancel</a>
        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    </div>
</div>

