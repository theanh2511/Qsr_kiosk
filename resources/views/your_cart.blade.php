{{-- resources/views/admin/dashboard.blade.php --}}

{{--@extends('layouts.main')--}}
@extends('layouts.main')

@section('title')
    {{ trans('system.screen-your-cart') }}
@endsection

@section('content_header')
    <span class="text-header">{{ trans('master_product.screen-title-detail') }}</span>
    <div class="btn-group pull-right">
        <button type="button" id="btn-save" class="btn btn-primary">{{ trans('system.btn-save') }}</button>
        <button type="button" id="btn-delete" class="btn btn-primary">{{ trans('system.btn-delete') }}</button>
        {{--<button type="button" id="btn-cancel" class="btn btn-primary">{{ trans('system.btn-cancel') }}</button>--}}
        <button type="button" id="btn-back" class="btn btn-primary">{{ trans('system.btn-back') }}</button>
    </div>
@stop

@section('content')
    <div class="row form-horizontal">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="tbl-explorer">
                                <thead>
                                <tr class="col-table-header text-center">
                                    <th class="text-center">{{ trans('master_product.name') }}</th>
                                    <th class="text-center" width="10%">{{ trans('master_product.Unit') }}</th>
                                    <th class="text-center" width="10%">{{ trans('master_product.Quantity') }}</th>
                                    <th class="text-center" width="15%">{{ trans('master_product.UnitPrice') }}</th>
                                    <th class="text-center" width="15%">{{ trans('master_product.Amount') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($products)=='0')
                                    <tr>
                                        <td class="text-center" colspan="5">{{ trans('master_product.EmptyCart') }}</td>
                                    </tr>
                                @else
                                    @foreach($products as $item)
                                        <tr>
                                            <td class="hidden">
                                                <span class="product-code">{{$item['ProductCode']}}</span>
                                            </td>
                                            <td class="text-left">
                                                <i class="fa fa-minus-circle text-danger cursor-pointer remove-row"
                                                   aria-hidden="true" title="Remove row"></i>
                                                <span class="product-name">{{$item['ProductName']}}</span>
                                            </td>
                                            <td class="text-left product-unit">{{$item['Unit']}}</td>
                                            <td class="text-right">
                                                <div class="input-group" style="width: 120px;">
                                            <span class="input-group-addon cursor-pointer btn-minus">
                                                <i class="glyphicon glyphicon-minus"></i>
                                            </span>
                                                    <input type="text"
                                                           class="form-control numeric numeric-input quantity"
                                                           value="{{formatNumber($item['Quantity'])}}" readonly/>
                                                    <span class="input-group-addon cursor-pointer btn-plus">
                                                <i class="glyphicon glyphicon-plus"></i>
                                            </span>
                                                </div>
                                            </td>
                                            <td class="text-right unit-price">{{formatNumber($item['UnitPrice'])}}</td>
                                            <td class="text-right amount">{{formatNumber($item['Amount'])}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-right"
                                        colspan="4">{{ trans('master_product.TotalDiscountAmount') }}</th>
                                    <th class="text-right"
                                        id="total-discount">{{formatNumber($total_cart_discount_amount??'0')}}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="4">{{ trans('master_product.TotalTaxAmount') }}</th>
                                    <th class="text-right" id="total-tax">{{formatNumber($total_cart_tax_amount??'0')}}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="4">{{ trans('master_product.TotalAmount') }}</th>
                                    <th class="text-right" id="total-amount">{{formatNumber($total_cart_amount??'0')}}
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <a id="btn-print" class="btn menu-catg pull-right" href="javascript:void(0);"
                           title="{{trans('master_product.BuyNow')}}">
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            <span> Buy now</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('content_hidden')

@stop

@section('css')
    {!! public_url('module/master/css/order.css') !!}
@stop

@section('js')
    {{--    {!! public_url('module/master/js/product.detail.js') !!}--}}
@stop