<div class="row">
        <div class="col-lg-4">

                <label for="lname">Last Name:</label>
                {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name']) !!}

        </div>
        <div class="col-lg-4">

                <label for="fname">First Name:</label>
                {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name']) !!}

        </div>

        <div class="col-lg-4">

                <label for="sjc_id">SJC ID:</label>
                {!! Form::text('sjc_id', null, ['class' => 'form-control', 'id' => 'sjc_id']) !!}

        </div>


        <div class="col-lg-4">

                <label for="username">Username:</label>
                {!! Form::text('username', null, ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="password">Password:</label>
                {!! Form::password('password', ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="password_confirmation">Confirm Password:</label>
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

        </div>


        <div class="col-lg-4">

                <label for="school_code">School Code:</label>
                {!! Form::select('school_code', $school_code,null , ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="type">Type:</label>
                {!! Form::select('type', $type,null , ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="course">Course:</label>
                {!! Form::select('course', $course,null , ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="school_of">School Of:</label>
                {!! Form::select('school_of', $school_of,null , ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="school_year">Semester:</label>
                {!! Form::text('semester', $semester->value, ['class' => 'form-control']) !!}

        </div>

        <div class="col-lg-4">

                <label for="school_year">School Year:</label>
                {!! Form::text('school_year', $school_year->value, ['class' => 'form-control']) !!}

        </div>
</div>
<br>
<div class="row">
    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <a href="{{ route('users.index') }}" type="button" class="btn btn-primary">Cancel</a>
        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    </div>
</div>


