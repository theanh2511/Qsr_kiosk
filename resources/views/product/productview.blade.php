{{-- resources/views/admin/dashboard.blade.php --}}

{{--@extends('layouts.main')--}}
@extends('layouts.main')

@section('title')
    {{ trans('master_product.screen-title-detail') }}
@endsection

@section('content_header')
    <span class="text-header">{{ trans('master_product.screen-title-detail') }}</span>
@stop

@section('content')
    <div class="header col-md-12 col-sm-12">
        <div class="pull-right">
            <a href="/your-cart" class="notification">
                <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
                <span>Your cart</span>
                <span class="badge">3</span>
            </a>
        </div>
    </div>

    <div class="flat-row flat-wooc">
        <div class="container">
            @if(empty($product))
                <div class="row">
                    <h4>Product is not exists</h4>
                </div>
            @else
                <div class="row">
                    <div class="woocommerce-page clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="flat-product-single-slider">
                                <div id="flat-product-flexslider">
                                    <ul class="slides">
                                        @foreach($product_images as $prod_img)
                                            <li>
                                                <img width="570" height="570" alt="product-single" src="{{$prod_img}}"
                                                     class="attachment-themesflat-gallery-product size-themesflat-gallery-product"
                                                     style="height: 360px;"/>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="flat-product-carousel">
                                    <ul class="slides">
                                        @foreach($product_images as $prod_img)
                                            <li>
                                                <img width="100px" height="100px" alt="product-single"
                                                     src="{{$prod_img}}"
                                                     style="height: 100px;"/>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div><!-- /.flat-portfolio-single-slider -->
                        </div><!--/.col-md-6 -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="entry-summary">
                                <h2 class="product_title">{{$product->Name??''}}</h2>

                                <p class="price">{{formatNumber($product->UnitPrice??'0')}} VNĐ</p>

                                <div class="">{!! $product->ProductInfo??'' !!}</div>

                                <div class="quantity">

                                    <div class="input-group" style="width: 120px;">
                                            <span class="input-group-addon cursor-pointer btn-minus">
                                                <i class="glyphicon glyphicon-minus"></i>
                                            </span>
                                        <input type="text"
                                               class="form-control numeric numeric-input quantity"
                                               value="1" readonly/>
                                        <span class="input-group-addon cursor-pointer btn-plus">
                                                <i class="glyphicon glyphicon-plus"></i>
                                            </span>
                                    </div>
                                    {{--<button type="button" class="btn btn-default">--}}
                                    {{--<i class="fa fa-video-camera" aria-hidden="true"></i>--}}
                                    {{--</button>--}}
                                </div>

                                <div class="related-product form-group">
                                    <p>Sản phẩm bao gồm</p>
                                    <ul>
                                        <li>Sản phẩm A</li>
                                        <li>Sản phẩm B</li>
                                        <li>Sản phẩm C</li>
                                    </ul>
                                </div>

                            </div><!-- /.entry-summary -->
                        </div><!--/.col-md-8 -->
                    </div><!--/.woocommerce-page -->
                </div><!--/.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="flat-accordion">
                            <div class="flat-toggle">
                                <h4 class="toggle-title active">{{ trans('master_product.RelativeProduct') }}</h4>
                                <div class="toggle-content">
                                    Sản phẩm liên quan
                                </div>
                            </div><!-- /toggle -->


                        </div><!-- /.flat-accordion -->
                    </div><!--/.col-md-12 -->
                </div><!--/.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="flat-accordion">
                            <div class="flat-toggle">
                                <h4 class="toggle-title active">{{ trans('master_product.Description') }}</h4>
                                <div class="toggle-content">
                                    <p>{!! $product->Description??'' !!}</p>
                                </div>
                            </div><!-- /toggle -->


                        </div><!-- /.flat-accordion -->
                    </div><!--/.col-md-12 -->
                </div><!--/.row -->
        @endif
        <!--  <div class="flat-divider d62px"></div> -->
        </div><!--/.container -->
    </div><!--/.flat-row -->


    {{--<div class="modal fade" id="myModal" role="dialog" style="margin-top: 450px;">--}}
    {{--<div class="modal-content" style="background-color: transparent;">--}}
    {{--<video width="640" height="480" controls autoplay id="video"--}}
    {{--style="margin-left: auto; margin-right: auto; display: block;">--}}
    {{--<source src="/videos/Food intro.mp4" type="video/mp4">--}}
    {{--</video>--}}
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
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
            <a href="#" style="width: 100%;height: 100%;" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>
                <span>Back</span>
            </a>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button disabled">
            {{--<a href="#">--}}
            {{--<i class="fa fa-arrow-right fa-3x" aria-hidden="true"></i>--}}
            {{--<span>Next</span>--}}
            {{--</a>--}}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 btn btn-default footer-button">
            <a href="#" class="notification">
                <i class="fa fa-check-square-o fa-3x" aria-hidden="true"></i>
                <span>Add to cart</span>
            </a>
        </div>
    </div>
@stop

@section('content_hidden')

@stop

@section('css')
    {{--{!! public_url('module/master/css/product.detail.css') !!}--}}
@stop

@section('js')
    {{--{!! public_url('module/master/js/product.detail.js') !!}--}}
@stop