@php
    $userCat = auth()->user()->user_cat;
    $links = DB::select('SELECT DISTINCT user_links.id, user_links.page_id, user_links.link_url, user_links.link_name, user_links.link_image, user_links.link_parent FROM user_cat_links INNER JOIN user_links ON user_cat_links.link_id = user_links.id WHERE user_cat_links.cat_id = :id ORDER BY user_links.link_name ASC',['id' => $userCat]);
    $parents = array();
    $child = array();
    foreach ($links as $row_links) {
        if ($row_links->link_parent == 0) {
            $parents[] = $row_links;
        } else {
            $child[] = $row_links;
        }
    }
@endphp




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ministry of Finance">
    <title>OHCS HCMIS</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{asset('favicons.ico')}}">
    <!-- Base Styling  -->


    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('assets/plugins/calendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/calendar/fullcalendar.print.min.css')}}" media="print">

    <link rel="stylesheet" href="{{asset('assets/main/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/main/css/style.css')}}">
</head>

<body>
    <div id="main-wrapper" class="show">

        <!-- start section sidebar -->
        <aside class="left-panel nicescroll-box">
            <nav class="navigation">
                <ul class="list-unstyled main-menu">
                    <li class="has-submenu active">
                        <a href="/">
                            <i class="fas fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>

                    {{-- @if ($parent->page_id == $pageName) @endif --}}
                   
                    @foreach ($parents as $parent)
                   
                    <li class="has-submenu">
                        <a href="javascript:void()" class="has-arrow mm-collapsed">
                            <i class="{{$parent->link_image}}"></i>
                            <span class="nav-label">{{$parent->link_name}}</span>
                            {{-- <span class="badge bg-danger rounded-pill ms-2">New</span> --}}
                        </a>
                        <ul class="list-unstyled mm-collapse">
                            @foreach ($child as $sub)
                                @if ($parent->id == $sub->link_parent)
                                  <li><a href="{{ route($sub->link_url)}}">{{ $sub->link_name}}</a></li>
                                @endif
                               
                            @endforeach
                        </ul>
                    </li>

                    @endforeach
                    
                </ul>
            </nav>
            <div class="sidebar-widgets">
                <div class="top-sidebar box-shadow mx-25 m-b-30 p-b-20 text-center">
                    <a href="#">
                        {{-- <img src="{{asset('images/ohcslogo.png')}}" class="side-img" alt="img" width="200"> --}}
                    </a>
                </div>
                {{-- <div class="copyright text-center">
                    <p class="mb-0"> HCMIS</p>
                    <p class="mb-0"> © {{Date('Y')}} </p>
                </div> --}}
            </div>
        </aside>
        <!-- End section sidebar -->


        <!-- start logo components -->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="/"><img class="brand-title" src="{{asset('images/ohcslogo.png')}}" alt="" ></a>
            </div>
        </div>
        <!-- End logo components -->


        <!-- start section header -->
        <div class="header">
            <header class="top-head container-fluid">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                    <div class="left-header content-header__menu">
                        <ul class="list-unstyled">
                            <li class="nav-link btn">
                                <a href="#"><i class="far fa-calendar-check"></i> <span> -----</span></a>
                            </li>
                            <li class="nav-link btn">
                                <a href=""><i class="far fa-file-alt"></i> <span> --- --</span></a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="header-right">
                    <div class="fullscreen notification_dropdown widget-5">
                        <div class="full">
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="fas fa-expand"></i>
                            </a>
                        </div>
                    </div>
                    <div class="widget-6">
                        <div class="cart-wrapper">
                            <div class="cart-icon">
                                <a class="cart-control" href="#">
                                    <i class="fas fa-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                            </div>
                            <div class="cart-dropdown-form dropdown-container">
                                <div class="form-content">
                                    <div class="widget-media main-scroll nicescroll-box">
                                        <ul class="timeline">
                                            <li>
                                                <h6 class="mb-0">Notitications</h6>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media mr-2">
                                                        <img alt="image" src="{{asset('assets/images/avtar/1.jpg')}}">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1 ">Incoming Message</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                    <a class="all-notification btn btn-primary" href="#">
                                        See all notifications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-account-wrapper widget-7">
                        <div class="account-wrapper">
                            <div class="account-control">
                                <a class="login header-profile" href="#" title="Sign in">
                                    <div class="header-info">
                                        <span>{{auth()->user()->name}}</span>
                                        <small>{{auth()->user()->title}}</small>
                                    </div>
                                    @if (!empty(auth()->user()->photoUrl))
                                       <img src="data:image/jpeg;base64,{{auth()->user()->photoUrl}}" alt="people">
                                    @else
                                    <img src="{{asset('avater.png')}}" alt="people">
                                    @endif
                                    
                                </a>
                                <div class="account-dropdown-form dropdown-container">
                                    <div class="form-content">
                                        <a href="{{route('update-user-information')}}">
                                            <i class="far fa-user"></i>
                                            <span class="ml-2">Profile</span>
                                        </a>
                                        
                                        <form action="{{route('log-out-user')}}" method="POST">
                                            @csrf
                                            <button class=" btn fas fa-sign-in-alt"> Logout</button>
                                        </form>
                                        

                                        {{-- <a href="">
                                            <i class="fas fa-sign-in-alt"></i>
                                            <span class="ml-2">Logout </span>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- End section header -->


        <!-- start section content -->
        @yield('content')
        <!-- End section content -->


        <!-- start section footer -->
        <div class="footer">
            <div class="copyright">
                <p class="mb-0">Copyright © Designed &amp; Developed by <a href="#" target="_blank">OHCS ICT TEAM</a>
                    
                        {{Date('Y')}}
                    
                </p>
            </div>
        </div>
        <!-- End section footer -->

        
    </div>
    <!-- JQuery v3.5.1 -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/jquery3-2.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Moment -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <!-- Date Range Picker -->
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.min.js')}}"></script>
    <!-- Datatable -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/init-tdatatable.js')}}"></script>
    <!-- Chart js -->
    {{-- <script src="{{asset('assets/plugins/chart/chart/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/charts-custom.js')}}"></script> --}}
    <!-- Main Custom JQuery -->
    
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    @yield('java_script')


    <script src="{{asset('assets/js/toggleFullScreen.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    

   

</body>

</html>