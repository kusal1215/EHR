<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/img/favicon.ico')}}">
    <title>EHR</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/bootstrap-datetimepicker.min.css')}}">

    @yield('header')

    <script src="{{asset('/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('/assets/js/respond.min.js')}}"></script>
    @php
    $curr_url = Route::currentRouteName();
    @endphp
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{url('/patient')}}" class="logo">
                    <img src="{{asset('/assets/img/logo.png')}}" width="35" height="35" alt=""> <span>EHR</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="fa fa-comment-o"></i> <span
                            class="badge badge-pill bg-danger float-right">{{ $count }}</span></a>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{asset('/assets/img/user.jpg')}}" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" class="dropdown-item" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="{{ $curr_url=='PatientManager.patient'?'active':''}}">
                            <a href="{{route('PatientManager.patient')}}"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="{{ $curr_url=='PatientAppointmentManager.appointments'?'active':''}}">
                            <a href="{{route('PatientAppointmentManager.appointments')}}"><i class="fa fa-calendar"></i>
                                <span>Appointments</span></a>
                        </li>
                        <li class="{{ $curr_url=='PatientReportManager.reports'?'active':''}}">
                            <a href="{{route('PatientReportManager.reports')}}"><i class="fa fa-file-text"></i>
                                <span>Reports</span></a>
                        </li>
                        <li class="{{ $curr_url=='/chatify'?'active':''}}">
                            <a href="{{url('/chatify')}}"><i class="fa fa-comments"></i> <span>Chat</span> <span
                                    class="badge badge-pill bg-primary float-right">{{ $count }}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{asset('/assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('/assets/js/Chart.bundle.js')}}"></script>
    <script src="{{asset('/assets/js/chart.js')}}"></script>
    <script src="{{asset('/assets/js/app.js')}}"></script>
    <script src="{{asset('/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });

    </script>

    <script>
        $('select').select2({
            matcher: function (params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') {
                    return null;
                }

                // `params.term` is the user's search term
                // `data.id` should be checked against
                // `data.text` should be checked against
                var q = params.term.toLowerCase();
                if (data.text.toLowerCase().indexOf(q) > -1 || data.id.toLowerCase().indexOf(q) > -1) {
                    return $.extend({}, data, true);
                }

                // Return `null` if the term should not be displayed
                return null;
            }
        });

    </script>

    @yield('js')
</body>



</html>
