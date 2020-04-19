<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Trishapta - Admin Panel</title>
    <meta name="description" content="overview &amp; stats"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('backend/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('backend/css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/js/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/daterangepicker.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('backend/css/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('backend/css/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.min.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap3-wysihtml5.min.css')}}">
@yield('page_specific_css')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    @yield('backend-content')
    @include('backend.layouts.footer')
</div>
<!-- jQuery 3 -->
<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('backend/js/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/select2.full.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('backend/js/raphael.min.js')}}"></script>
<script src="{{asset('backend/js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('backend/js/jquery.sparkline.min.js')}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{asset('backend/js/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('backend/js/moment.min.js')}}"></script>

<!-- datepicker -->
<script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap-timepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('backend/js/bootstrap3-wysihtml5.all.js')}}"></script>
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/iCheck/icheck.js')}}"></script>
<script src="{{asset('backend/js/daterangepicker.js')}}"></script>
<script src="{{asset('backend/js/Chart.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('backend/js/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('backend/js/fastclick.js')}}"></script>
<script src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/js/adminlte.min.js')}}"></script>
<script>
    var base_url = '{{URL::to('/')}}';
    var ajaxType;
    var ajaxPartialUrl;
    var ajaxData;
    var ajaxResult;
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>
<script>
    //Global ajax call function
    function ajaxCall(type, partialUrl, data) {
        $.ajax({
            type: type,
            url: base_url + partialUrl,
            data: data,
            async: false,
            success: function (response) {
                //alert(response.data);
                ajaxResult = response.data;
            },
            error: function (response) {
                //alert(response.data);
                ajaxResult = response.data;
            }
        });

        return ajaxResult;
    }
</script>
@yield('page_specific_js')
</body>
</html>