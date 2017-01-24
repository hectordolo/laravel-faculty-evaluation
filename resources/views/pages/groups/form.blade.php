<div class="row">
    <div class="col-lg-6 form-group">
        <label for="name">Question Group:</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'question']) !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-6 form-group">
        <label for="percentage">Question Group Percentage:</label>
        {!! Form::text('percentage', null, ['class' => 'form-control', 'id' => 'question']) !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-6 form-group">
        <label for="priority">Priority of Group:</label>
        {!! Form::text('priority', null, ['class' => 'form-control', 'id' => 'question']) !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-6 form-group">
        <label for="for_id">Group For:</label>
        {!! Form::select('for_id', $for,null , ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-6 form-group">
        <label for="active">Active?:</label>
        {!! Form::hidden('active', '0') !!}
        {!! Form::checkbox('active', '1', null) !!}
    </div>
</div>

<div class="ln_solid"></div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <a href="{{ route('groups.index') }}" type="button" class="btn btn-primary">Cancel</a>
        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    </div>
</div>
