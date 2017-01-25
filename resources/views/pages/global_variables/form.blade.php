<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6 form-group">
            <label for="name">Name:</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'question']) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 form-group">
            <label for="value">Value:</label>
            {!! Form::text('value', null, ['class' => 'form-control', 'id' => 'question']) !!}
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="row">
        <div class="col-lg-6">
            <a href="{{ route('global_variables.index') }}" type="button" class="btn btn-primary">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        </div>
    </div>
</div>
