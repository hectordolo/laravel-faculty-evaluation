<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CRUD Laravel">
    <meta name="author" content="Hector Dolo">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ URL::asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <script>
        $.get("{{route('profile.name')}}", function (data) {
            $('#nav_name').html(data.last_name + ', ' + data.first_name);
        });
    </script>

    <style>
        @media print{
            .no-print{
                display: none;
            }
        }
    </style>

    @yield('header-scripts')

</head>

<body id="wrapper">

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <span id="nav_name"> </span> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{route('password.edit')}}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <img src="{{route('sjc_logo')}}" alt="..." class="img-responsive">
                </li>

                <li><a href="{{url('/')}}"><i class="fa fa-dashboard fa-fw"></i> Home</a></li>

                @role(['faculty','student'])

                <li><a href="#"><i class="fa fa-question"></i> Evaluation<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">
                        @role('faculty')
                            <li><a href="{{route('deans.index')}}">Dean Evaluation</a></li>
                        @endrole

                        @role('student')
                            <li><a href="{{route('faculty.index')}}">Faculty Evaluation</a></li>
                        @endrole
                    </ul>
                </li>

                @endrole

                @ability('system-administrator', 'questions-create,questions-read,questions-update,questions-delete')

                    <li><a href="#"><i class="fa fa-question"></i> Questions Management <span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">

                            @permission('questions-read')
                                <li><a href="{{route('questions.index')}}">Questions Lists</a></li>
                            @endpermission

                            @permission('questions-read')
                                <li><a href="{{route('groups.index')}}">Groups Lists</a></li>
                            @endpermission

                            @permission('questions-read')
                            <li><a href="{{route('for.index')}}">Questions For Lists</a></li>
                            @endpermission

                        </ul>
                    </li>

                @endability

                @ability('system-administrator,user-manager', 'users-read,users-migrate')

                    <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Users Management</a></li>
                @endability

                @role(['system-administrator','reports'])

                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Evaluation Result<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">
                        <li><a href="{{route('deans_reports.index')}}">Dean Evaluation Results</a></li>
                        <li><a href="{{route('faculty_reports.index')}}">Faculty Evaluation Results</a></li>
                    </ul>
                </li>
                @endrole

                @role('system-administrator')
                    <li><a href="#"><i class="fa fa-gears"></i> Settings <span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">

                            <li><a href="{{route('migrate_options.index')}}"> Migrate Records</a></li>
                            <li><a href="{{route('global_variables.index')}}">Global Variables Lists</a></li>
                        </ul>
                    </li>
                @endrole

            </ul>
        </div>
    </div>
</nav>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">@yield('page-header')</h3>
        </div>
    </div>

    @include('flash::message')

    @yield('page-content')

</div>
<!-- /#page-wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ URL::asset('vendor/metisMenu/metisMenu.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ URL::asset('dist/js/sb-admin-2.js') }}"></script>

@yield('footer-scripts')

</body>
</html>
