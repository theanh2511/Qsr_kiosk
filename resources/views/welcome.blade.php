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
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    {!! public_url('css/jquery-ui.css')!!}
    <style>
        .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #555;
            color: white;
            font-size: 42px;
            padding: 16px 24px;
            height: 100px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            opacity: 0.7 !important;
            background-color: #e44c2a;
        }

        .btn:hover {
            opacity: 1 !important;
            color: white;
        }
    </style>
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
<img src="/images/shop/fast-food.jpg" width="100%" height="100%" style="position: fixed;"/>
<div class="form-group">
    <a class="btn" href="/select-language">Touch to order</a>
</div>

{{--{!! public_url('js/core/libraries/jquery.min.js')!!}--}}
{{--{!! public_url('js/core/libraries/bootstrap.min.js')!!}--}}
{{--{!! public_url('js/core/libraries/jquery_ui/jquery-ui.min.js')!!}--}}
{{--{!! public_url('module/order/js/jquery-validate.js') !!}--}}
{{--{!! public_url('module/order/js/_tempOrder.js') !!}--}}
{{--{!! public_url('js/common/jquery.alerts.js')!!}--}}
{{--{!! public_url('plugins/add-to-cart/js/flyto.js') !!}--}}
{{--{!! public_url('module/order/js/jquery.flexslider-min.js') !!}--}}
{{--{!! public_url('js/common/jQuery.print.js') !!}--}}
{{--{!! public_url('js/message/msg.js') !!}--}}
{{--{!! public_url('module/order/js/order.js') !!}--}}
<script>
    var _sysLocate = '{!! config('app.locale') !!}';
</script>
@yield('js')
</body>

<!-- Mirrored from corpthemes.com/html/sumi/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Nov 2018 01:42:07 GMT -->
</html>