<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->

<!-- Mirrored from corpthemes.com/html/sumi/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Nov 2018 01:41:17 GMT -->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>@yield('title')</title>

    <meta name="author" content="themesflat.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
{!! public_url('css/jquery-ui.css')!!}
{{--<!-- Theme Style -->--}}
{!! public_url('module/order/css/style.css') !!}
{!! public_url('module/order/css/responsive.css') !!}
{!! public_url('css/jquery.alerts.css')!!}
{!! public_url('css/selforder.css')!!}
@yield('css')

<!-- Favicon and touch icons  -->
    <link href="icon/apple-touch-icon-48-precomposed.png" rel="apple-touch-icon" sizes="48x48">
    <link href="icon/apple-touch-icon-32-precomposed.png" rel="apple-touch-icon-precomposed">
    <link href="icon/favicon.png" rel="shortcut icon">

    <!--[if lt IE 9]>
    <script src="javascript/html5shiv.js"></script>
    <script src="javascript/respond.min.js"></script>
    <![endif]-->
</head>

<body class="">
<section class="loading-overlay">
    <div class="Loading-Page">
        <h2 class="loader">Loading</h2>
    </div>
</section>

<div class="box">
    {{--<div class="container" style="margin-top: 10px;">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<a class="btn menu-catg" href="/order">--}}
                    {{--<i class="fa fa-home" aria-hidden="true"></i>--}}
                {{--</a>--}}
                {{--@foreach($catalogs as $catg)--}}

                    {{--<a href="/order/?catg={{ $catg->Code }}">--}}
                        {{--<button type="button" class="btn menu-catg">{{ $catg->Name }}</button>--}}
                    {{--</a>--}}

                {{--@endforeach--}}

                {{--<a class="btn pull-right menu-catg cart" href="/your-cart">--}}
                    {{--<i class="fa fa-shopping-cart"></i>--}}
                    {{--<span class="label label-cart">{{$total_cart_quan??'0'}}</span>--}}
                {{--</a>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="clearfix" style="border: solid 1px #e44c2a; margin-top: 10px;"></div>--}}


    @yield('content')


    <footer class="footer">

    </footer>

</div><!--box -->

{!! public_url('js/core/libraries/jquery.min.js')!!}
{!! public_url('js/core/libraries/bootstrap.min.js')!!}
{!! public_url('js/core/libraries/jquery_ui/jquery-ui.min.js')!!}
{!! public_url('module/order/js/jquery-validate.js') !!}
{!! public_url('module/order/js/_tempOrder.js') !!}
{!! public_url('js/common/jquery.alerts.js')!!}
{!! public_url('plugins/add-to-cart/js/flyto.js') !!}
{!! public_url('module/order/js/jquery.flexslider-min.js') !!}
{!! public_url('js/common/jQuery.print.js') !!}
{!! public_url('js/message/msg.js') !!}
{!! public_url('module/order/js/order.js') !!}
<script>
    var _sysLocate = '{!! config('app.locale') !!}';
</script>
@yield('js')
</body>

<!-- Mirrored from corpthemes.com/html/sumi/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Nov 2018 01:42:07 GMT -->
</html>