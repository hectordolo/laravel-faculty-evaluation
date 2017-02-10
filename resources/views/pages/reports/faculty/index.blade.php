@extends('layouts.admin')

@section('title')
    List of Faculty
@endsection

@section('page-header')
    List of Faculty
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title" style="width: 15%">Faculty ID</th>
                        <th class="column-title">Faculty Name</th>
                        <th class="column-title" style="width: 10%">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection