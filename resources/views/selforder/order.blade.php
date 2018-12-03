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

</div>

<div class="col-md-12 col-sm-12 text-center flat-row flat-wooc">
    <h2>{{$catg_name}}</h2>
    @for($i=1;$i<=3;$i++)
        @foreach($products as $prod)
            <div class="col-sm-4 col-md-4 col-xs-6 product-box">
                <div class="product effect1">
                    <div class="box-wrap">
                        <div class="box-image">
                            <a href="/master/product-detail/{{$prod->id}}">
                                <img src="{{$prod->ImageUrl}}" alt="images" title="{{$prod->Name}}">
                                <button class="btn btn-view-detail" primary-key="{{$prod->id}}">
                                    {{$prod->Name}}
                                </button>
                            </a>
                        </div>

                        <div class="">
                            {{--<ul class="list-group list-group-horizontal">--}}
                            {{--<li class="list-group-item">--}}
                            {{--@if(formatNumber($prod->DiscountRate,0,1)!=0)--}}
                            {{--<p class="original-price">SalesOff:--}}
                            {{--<b>{{formatNumber($prod->DiscountRate,0,1).' %'}}</b>&emsp;&emsp;--}}
                            {{--<strike>{{formatNumber($prod->OriginalUnitPrice)}}VNĐ</strike>--}}
                            {{--</p>--}}
                            {{--@endif--}}
                            {{--<span class="show-price" title="{{formatNumber($prod->UnitPrice)}} VNĐ">{{formatNumber($prod->UnitPrice)}}--}}
                            {{--VNĐ</span>--}}

                            {{--</li>--}}
                            {{--<li class="list-group-item">--}}
                            {{--<span class="list-group-item pull-right add-to-cart cursor-pointer"--}}
                            {{--product-code="{{$prod->Code}}" product-name="{{$prod->Name}}"--}}
                            {{--product-unit="{{$prod->Unit}}" product-unitprice="{{$prod->UnitPrice}}">--}}
                            {{--<i class="fa fa-shopping-cart fa-2x" title="Add to cart"></i>--}}
                            {{--</span>--}}
                            {{--</li>--}}

                            {{--<li class="list-group-item pull-right add-to-cart cursor-pointer"--}}
                            {{--product-code="{{$prod->Code}}" product-name="{{$prod->Name}}"--}}
                            {{--product-unit="{{$prod->Unit}}" product-unitprice="{{$prod->UnitPrice}}">--}}
                            {{--<i class="fa fa-shopping-cart fa-2x" title="Add to cart"></i>--}}
                            {{--</li>--}}
                            {{--</ul>--}}


                            <ul class="list-inline list-group" style="height: 50px;">
                                <li class="list-inline-item" style="margin-top: 15px;">
                                    @if(formatNumber($prod->DiscountRate,0,1)!=0)
                                        <p class="original-price">SalesOff:
                                            <b>{{formatNumber($prod->DiscountRate,0,1).' %'}}</b>&emsp;&emsp;
                                            <strike>{{formatNumber($prod->OriginalUnitPrice)}}VNĐ</strike>
                                        </p>
                                    @endif
                                    <span class="show-price" title="{{formatNumber($prod->UnitPrice)}} VNĐ">{{formatNumber($prod->UnitPrice)}}
                                        VNĐ</span>
                                </li>
                                <li class="list-inline-item pull-right">
                                    <span class="list-group-item pull-right add-to-cart cursor-pointer"
                                          product-code="{{$prod->Code}}" product-name="{{$prod->Name}}"
                                          product-unit="{{$prod->Unit}}" product-unitprice="{{$prod->UnitPrice}}">
                                    <i class="fa fa-shopping-cart fa-2x" title="Add to cart"></i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endfor
</div>

{{--<div class="col-md-12 col-sm-12">--}}
    {{--<div class="box-cart">--}}
        {{--<div class="nav">--}}
            {{--<ul>--}}
                {{--<li>SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS/li>--}}
                {{--<li>SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS</li>--}}
                {{--<li>SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS</li>--}}
                {{--<li>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<p>Tổng cộng: {{formatNumber($total_cart_amount)}} VNĐ--}}
                {{--<span class="pull-right cart-info"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}


<div class="footer col-md-12 col-sm-12">
    <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">
        <a href="/catalogs">
            <i class="fa fa-home fa-3x" aria-hidden="true"></i>
            <span>Home</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">
        <a href="#" style="width: 100%;height: 100%;">
            <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>
            <span>Previous page</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">
        <a href="#">
            <i class="fa fa-arrow-right fa-3x" aria-hidden="true"></i>
            <span>Next page</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">
        <a href="/your-cart" class="notification">
            <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
            <span>Your cart</span>
            <span class="badge label-cart">{{$total_cart_quan}}</span>
        </a>
    </div>
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
{!! public_url('module/order/js/order.js') !!}

<div class="hidden">
    @yield('content_hidden')
</div>


</body>
</html>
