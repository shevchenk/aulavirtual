<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        @section('author')
        <meta name="author" content="Jorge Salcedo (Shevchenko)">
        @show

        <link rel="shortcut icon" href="favicon.ico">

        @section('description')
        <meta name="description" content="Software Eficiencia de Entrega de Certificados ">
        @show
        <title>
            @section('title')
                AULA (JS)
            @show
        </title>

        @section('include')
            {{ Html::style('lib/bootstrap/css/bootstrap.min.css') }}
            {{ Html::style('lib/font-awesome/css/font-awesome.min.css') }}
            {{ Html::style('lib/ionicons/css/ionicons.min.css') }}
            {{ Html::style('css/AdminLTE.min.css') }}
            {{ Html::style('css/skins/_all-skins.min.css') }}
            {{ Html::style('lib/sweetalert-master/dist/sweetalert.css') }}

            {{ Html::script('lib/jQuery/jquery-2.2.3.min.js') }}
            {{ Html::script('lib/bootstrap/js/bootstrap.min.js') }}
            {{ Html::script('lib/fastclick/fastclick.js') }}
            {{ Html::script('lib/slimScroll/jquery.slimscroll.min.js') }}
            {{ Html::script('js/app.min.js') }}
            {{ Html::script('lib/sweetalert-master/dist/sweetalert.min.js') }}
        @show
        @include( 'include.css.master' )
        @include( 'include.js.master' )
    </head>

    <body class="skin-blue sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <header class="main-header">
                @include( 'layout.admin_head' )
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                @include( 'layout.admin_left' )
                </section>
            </aside>

            <div class="content-wrapper">
                <div class="msjG" style="display: none;"> </div>
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                  <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2017-2018 <a href="http://jssoluciones.com">JS</a>.</strong> All rights
                reserved.
            </footer>
        </div><!-- ./wrapper -->

        @yield('form')
        @include( 'include.form.imagen' )
        @include( 'include.form.mensaje' )
    </body>
</html>
