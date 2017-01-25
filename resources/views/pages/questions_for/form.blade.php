<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6 form-group">
            <label for="name">Question For:</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('for.index') }}" type="button" class="btn btn-primary">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
        </div>
    </div>
</div>
