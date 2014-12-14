<!DOCTYPE html>
<html class="no-js">

<head>
    <title>Main Page</title>
    <!-- Bootstrap -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/bootstrap-responsive.min.css') }}
    {{HTML::style('assets/css/styles.css')}}


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
</head>

<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Admin Panel</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="#">Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a tabindex="-1" href="login.html">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="active">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                        </a>
                        <ul class="dropdown-menu" id="menu1">
                            <li>
                                <a href="#">Tools <i class="icon-arrow-right"></i>

                                </a>
                                <ul class="dropdown-menu sub-menu">
                                    <li>
                                        <a href="#">Reports</a>
                                    </li>
                                    <li>
                                        <a href="#">Logs</a>
                                    </li>
                                    <li>
                                        <a href="#">Errors</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">SEO Settings</a>
                            </li>
                            <li>
                                <a href="#">Other Link</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">Other Link</a>
                            </li>
                            <li>
                                <a href="#">Other Link</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="#">Blog</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="#">News</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="#">Custom Pages</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="#">Calendar</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a tabindex="-1" href="#">FAQ</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="#">User List</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="#">Search</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="#">Permissions</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<div class="container-fluid">
<div class="row-fluid">
<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        <li class="active">
            <a href="index.html"><i class="icon-chevron-right"></i> Dashboard</a>
        </li>
        <li>
            <a href="calendar.html"><i class="icon-chevron-right"></i> Calendar</a>
        </li>
        <li>
            <a href="stats.html"><i class="icon-chevron-right"></i> Statistics (Charts)</a>
        </li>
        <li>
            <a href="form.html"><i class="icon-chevron-right"></i> Forms</a>
        </li>
        <li>
            <a href="tables.html"><i class="icon-chevron-right"></i> Tables</a>
        </li>
        <li>
            <a href="buttons.html"><i class="icon-chevron-right"></i> Buttons & Icons</a>
        </li>
        <li>
            <a href="editors.html"><i class="icon-chevron-right"></i> WYSIWYG Editors</a>
        </li>
        <li>
            <a href="interface.html"><i class="icon-chevron-right"></i> UI & Interface</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-success pull-right">731</span> Orders</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-success pull-right">812</span> Invoices</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-info pull-right">27</span> Clients</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-info pull-right">1,234</span> Users</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-info pull-right">2,221</span> Messages</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-info pull-right">11</span> Reports</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-important pull-right">83</span> Errors</a>
        </li>
        <li>
            <a href="#"><span class="badge badge-warning pull-right">4,231</span> Logs</a>
        </li>
    </ul>
</div>

<!--/span-->
<div class="span9" id="content">
<div class="row-fluid">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Success</h4>
        The operation completed successfully</div>
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="breadcrumb">
                <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                <li>
                    <a href="#">Dashboard</a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="#">Settings</a> <span class="divider">/</span>
                </li>
                <li class="active">Tools</li>
            </ul>
        </div>
    </div>
</div> 
<!-- main content -->
    <div class="container">

    @yield('container')
     
    </div> 
        <!-- /block -->
    </div>
</div>

   
</div>
<hr>
<footer>
    <p>&copy; Edu Tech Solutions BD</p>
</footer>


<!--/.fluid-container-->
{{ HTML::script('assets/js/jquery-1.9.1.min.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }}
{{HTML::script('assets/js/scripts.js')}}

{{--{{ HTML::script('assets/js/jquery.tablesorter.min.js') }}--}}
{{--{{ HTML::script('assets/js/jquery.jscroll.min.js') }}--}}
{{--{{HTML::script('assets/js/jquery.dataTables.min.js')}}--}}


</body>

</html>