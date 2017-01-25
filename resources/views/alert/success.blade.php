@if (Session::has('success'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5><i class="icon fa fa-info-circle"></i> Success!</h5>
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
@endif