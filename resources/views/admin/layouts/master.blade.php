<!DOCTYPE html>
<html><head>
    <meta charset="UTF-8">
    <title>Administrator | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://roomlook.com/packages/pingpong/admin/components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://roomlook.com/packages/pingpong/admin/components/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css">
<!-- Morris chart -->
<link href="https://roomlook.com/packages/pingpong/admin/adminlte/css/morris/morris.css" rel="stylesheet" type="text/css">
<!-- jvectormap -->
<link href="https://roomlook.com/packages/pingpong/admin/adminlte/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
<!-- Date Picker -->
<link href="https://roomlook.com/packages/pingpong/admin/adminlte/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
<!-- Daterange picker -->
<link href="https://roomlook.com/packages/pingpong/admin/adminlte/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
<!-- bootstrap wysihtml5 - text editor -->
<link href="https://roomlook.com/packages/pingpong/admin/adminlte/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css">
<!-- Theme style -->
<link href="https://roomlook.com/packages/pingpong/admin/adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    @yield('style')
</head>
<body class="skin-blue fixed">

    @include('admin::partials.header')

    <div class="wrapper row-offcanvas row-offcanvas-left">

        @include('admin::partials.sidebar')

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content-header')
            </section>

            <!-- Main content -->
            <section class="content">
                @include('admin::partials.flashes')
                @yield('content')
            </section>
        </aside>
        <!-- /.right-side -->
    </div>
    <!-- ./wrapper -->

    <!-- add new calendar event modal -->
     <script src="https://roomlook.com/packages/pingpong/admin/components/jquery/dist/jquery.min.js"></script>
<script src="https://roomlook.com/packages/pingpong/admin/components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://roomlook.com/packages/pingpong/admin/components/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="https://roomlook.com/packages/pingpong/admin/adminlte/js/AdminLTE/app.js" type="text/javascript"></script>
<script src="https://roomlook.com/packages/pingpong/admin/js/all.js" type="text/javascript"></script>
    <script src="/js/admin/script.js"></script>
    @yield('script')
</body>
</html>
