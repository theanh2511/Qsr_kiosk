<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    {{--Custom CSS--}}
{!! public_url('css/core.css') !!}
{!! public_url('css/jquery.alerts.css')!!}
{!! public_url('css/colorbox.css')!!}
{!! public_url('css/jquery-ui.css')!!}
{!! public_url('css/selforder.css')!!}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<div class="header col-md-12 col-sm-12">
    <div class="pull-right">
        <a href="/your-cart" class="notification">
            <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
            <span>Your cart</span>
            <span class="badge">3</span>
        </a>
    </div>
</div>

<div class="col-md-12 col-sm-12 text-center flat-row flat-wooc">
    <h2>Catalog</h2>
    @foreach($catalogs as $catg)

        <div class="col-md-3 col-sm-3 col-xs-3 catg-detail">
            <a href="/order/?catg={{ $catg->Code }}">
                <img src="{{$catg->ImageUrl}}" width="150px" height="100px">
                <span class="btn btn-default" style="width: 150px; font-size: 18px;">{{$catg->Name}}</span>
            </a>
        </div>
    @endforeach
</div>

<div class="footer col-md-12 col-sm-12">
    <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">
        <a href="/select-language" style="width: 100%;height: 100%;">
            <i class="fa fa-language fa-3x" aria-hidden="true"></i>
            <span class="footer-button">Language</span>
        </a>
    </div>

    {{--<div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">--}}
        {{--<i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>--}}
        {{--<span class="footer-button">Cart</span>--}}
    {{--</div>--}}

    {{--<div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button disabled">--}}
        {{--<i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>--}}
        {{--<span class="footer-button">Previous</span>--}}

    {{--</div>--}}

    {{--<div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button disabled">--}}
        {{--<a href="#">--}}
            {{--<i class="fa fa-arrow-right fa-3x" aria-hidden="true"></i>--}}
            {{--<span class="footer-button">Next</span>--}}
        {{--</a>--}}
    {{--</div>--}}
</div>

<script>
    var _sysLocate = '{!! config('app.locale') !!}';
</script>
{!! public_url('js/core/libraries/jquery.min.js')!!}
{!! public_url('js/core/libraries/bootstrap.min.js')!!}
{!! public_url('js/core/libraries/jquery_ui/jquery-ui.min.js')!!}
{!! public_url('js/plugins/ui/moment/moment.min.js')!!}
{!! public_url('js/plugins/loaders/blockui.min.js')!!}
{!! public_url('js/common/jquery.alerts.js')!!}
{!! public_url('js/common/jquery.colorbox.js')!!}
{!! public_url('js/common/jquery.balloon.js')!!}
{!! public_url('js/message/msg.js') !!}
{!! public_url('js/common/common.js') !!}


<div class="hidden">
    @yield('content_hidden')
</div>


</body>
</html>
