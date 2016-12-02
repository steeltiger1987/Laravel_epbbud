<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "Admin Panel" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("js/jquery.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("js/bootstrap.js") }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fullcalendar/fullcalendar.css')}}">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <link href="{{ asset("AdminLTE/dist/css/skins/skin-red.min.css")}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('AdminLTE/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <link href="{{ asset('AdminLTE/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset ("AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php
        use Illuminate\Support\Facades\Auth;
    ?>
</head>
<style>
    i {
        margin-left: 10px;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -ms-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }
    .fa-trash:hover {
        color: red;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -ms-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }
    .fa-edit:hover {
        color: forestgreen;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -ms-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }
    .dataTables_filter > label > input {
        border: 1px solid #d2d6de;
        border-radius: 4px;
    }
    .dataTables_filter {
        float: left;
        margin-left: 60%;

    }
    .paginate_button {
        margin-left: 8px;
        cursor: default;
    }
    .paginate_button:hover {
        cursor: default;
    }
    .modal-footer {
        text-align: center;
    }
    .lb {
        font-weight: normal;
    }
</style>
<body class="skin-red">
<div class="wrapper">

    <!-- Header -->
    @include('backend.header')

            <!-- Sidebar -->
    @include('backend.sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$page_title or "Page title"}}
                <small>{{ $page_description or null }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('backend.footer')

</div><!-- ./wrapper -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>
</html>
<script src="{{ asset ("js/jquery.js") }}"></script>
<script src="{{ asset ("js/bootstrap.js") }}" type="text/javascript"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ("AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js'></script>
<script src="{{asset('AdminLTE/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('AdminLTE/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{ asset ("js/bootstrap.js") }}" type="text/javascript"></script>
<script>
//    $(document).ready(function() {
//        var path = window.location.toString().split('/');
//        $('.active').removeClass('active');
//        $('#' + path[path.length - 1]).addClass('active');
//        $("[data-mask]").inputmask();
//    });
    $(document).bind('change', function() {
        $("[data-mask]").inputmask();
    });

</script>