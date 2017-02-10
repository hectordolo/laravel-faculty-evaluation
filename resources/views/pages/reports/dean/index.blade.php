@extends('layouts.admin')

@section('title')
    List of Department Heads
@endsection

@section('page-header')
    List of Department Heads
@endsection

@section('page-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 5%">#</th>
                        <th class="column-title" style="width: 15%">Dean ID</th>
                        <th class="column-title">Last Name</th>
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