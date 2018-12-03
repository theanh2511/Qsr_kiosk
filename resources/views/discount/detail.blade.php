{{-- resources/views/admin/dashboard.blade.php --}}

{{--@extends('layouts.main')--}}
@extends('adminlte::page')

@section('title')
    {{ trans('master_discount.screen-title-detail') }}
@endsection

@section('content_header')
    <span class="text-header">{{ trans('master_discount.screen-title-detail') }}</span>
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
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_discount.DocNo') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" value="{{$details->DocNo??''}}" class=" form-control required"
                                   placeholder="" data-field="DocNo">
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_discount.DocDate') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            {{--<input value="{{$details->Code??''}}" type="text" class=" form-control required"--}}
                            {{--data-field="DocDate">--}}
                            <input value="{{ \Carbon\Carbon::parse($details->DocDate??'')->format('m/d/Y')}}" type="tel"
                                   class="datepicker form-control required" data-field="DocDate">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_discount.EffectiveDate_Fr') }}</label>
                        <div class="col-md-4 col-sm-6 col-xs-12 date-from-to">
                            <input value="{{ \Carbon\Carbon::parse($details->EffectiveDate_Fr??'')->format('m/d/Y')}}"
                                   type="tel"
                                   class="datepicker form-control" data-field="EffectiveDate_Fr">
                            <span class="">～</span>
                            <input value="{{ \Carbon\Carbon::parse($details->EffectiveDate_To??'')->format('m/d/Y')}}"
                                   type="tel" class="datepicker form-control" data-field="EffectiveDate_To">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_discount.Description') }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea type="textarea" class="form-control" rows="3" id="Description"
                                      data-field="Description">{{$details->Description??''}}</textarea>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 class-detail">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="">{{ trans('master_discount.tab-quot-detail') }}</a>
                        </li>
                    </ul>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="tbl-detail">
                                <thead>
                                <tr class="col-table-header text-center">
                                    <th class="w-45px text-center">
                                        <i id="btn-add-row" class="fa fa-plus text-success-700 cursor-pointer"
                                           aria-hidden="true"></i>
                                    </th>
                                    <th class="text-center" width="20%">{{ trans('master_discount.ProductCode') }}</th>
                                    <th class="text-center">{{ trans('master_discount.ProductName') }}</th>
                                    <th class="text-center" width="10%">{{ trans('master_discount.ProductUnit') }}</th>
                                    <th class="text-center" width="10%">{{ trans('master_discount.DiscountRate') }}</th>
                                    <th class="text-center"
                                        width="10%">{{ trans('master_discount.DiscountAmount') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(empty($bizdoc_detail[0]))
                                    <tr class="">
                                        <td class="w-40px text-left">
                                            <i class="fa fa-minus-circle text-danger cursor-pointer remove-row"
                                               aria-hidden="true"></i>
                                            <span class="zstt">1</span>
                                            <span class="detail_primary_key hidden"></span>
                                        </td>
                                        <td class="text-center" width="20%">
                                            <div class="input-group">
                                                <input type="text"
                                                       class="form-control required product-code search-input"
                                                       placeholder="Product code"/>
                                                <span class="input-group-addon cursor-pointer btn-search"><i
                                                            class="glyphicon glyphicon-search"></i></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <input type="text" class="form-control product-name" disabled/>
                                        </td>
                                        <td class="text-center" width="10%">
                                            <input type="text" class="form-control product-unit" disabled/>
                                        </td>
                                        <td class="text-center">
                                            <input value="" type="text" placeholder="%"
                                                   class="form-control money discount-rate"
                                                   maxlength="15" real_len="2" decimal_len="2">
                                        </td>
                                        <td class="text-center">
                                            <input value="" type="text"
                                                   class="form-control money discount-amount"
                                                   maxlength="15" real_len="12" decimal_len="0">
                                        </td>
                                    </tr>
                                @else
                                    @foreach($bizdoc_detail as $biz)
                                        <tr class="">
                                            <td class="w-40px text-left">
                                                <i class="fa fa-minus-circle text-danger cursor-pointer remove-row"
                                                   aria-hidden="true"></i>
                                                <span class="zstt">{{$biz->DetailNo}}</span>
                                                <span class="detail_primary_key hidden"></span>
                                            </td>
                                            <td class="text-center" width="20%">
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control required product-code search-input"
                                                           placeholder="Product code" value="{{$biz->ProductCode}}"/>
                                                    <span class="input-group-addon cursor-pointer btn-search"><i
                                                                class="glyphicon glyphicon-search"></i></span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control product-name"
                                                       value="{{$biz->ProductName}}" disabled/>
                                            </td>
                                            <td class="text-center" width="10%">
                                                <input type="text" class="form-control product-unit"
                                                       value="{{$biz->Unit}}" disabled/>
                                            </td>
                                            <td class="text-center" width="20%">
                                                <input value="{{formatNumber($biz->DiscountRate??'0',2,1)}}" type="text"
                                                       id="unit_price"
                                                       class="form-control money discount-rate"
                                                       maxlength="5"
                                                       real_len="2" decimal_len="2">
                                            </td>
                                            <td class="text-center">
                                                <input value="{{formatNumber($biz->DiscountAmount??'0')}}" type="text"
                                                       class="form-control money discount-amount"
                                                       maxlength="15" real_len="12" decimal_len="0">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal" role="dialog" style="margin-top: 150px;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ trans('master_product.search-result') }}</h4>
                            </div>
                            <div class="modal-body" id="modal-search-result">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="tbl-explorer">
                                        <thead>
                                        <tr class="col-table-header text-center">
                                            <th class="w-40px text-center">
                                                <input type="checkbox" id="check-all" class="chk-edit">
                                            </th>
                                            <th class="text-center" width="20%">{{ trans('master_product.Code') }}</th>
                                            <th class="text-center">{{ trans('master_product.name') }}</th>
                                            <th class="text-center" width="10%">{{ trans('master_product.Unit') }}</th>
                                            <th class="text-center"
                                                width="10%">{{ trans('master_product.UnitCost') }}</th>
                                            <th class="text-center"
                                                width="10%">{{ trans('master_product.UnitPrice') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--@if(!empty($product))--}}
                                        {{--@foreach($product as $item)--}}
                                        {{--<tr class="" primary-key="{{$item->id}}">--}}
                                        {{--<td class="text-center">--}}
                                        {{--<input type="checkbox" class="check-all"--}}
                                        {{--primary-key="{{$item->id}}">--}}
                                        {{--</td>--}}
                                        {{--<td class="text-center">{{$item->Code}}</td>--}}
                                        {{--<td>{{$item->Name}}</td>--}}
                                        {{--<td class="text-left">{{$item->Unit}}</td>--}}
                                        {{--<td class="text-right">{{formatNumber($item->UnitCost)}}</td>--}}
                                        {{--<td class="text-right">{{formatNumber($item->UnitPrice)}}</td>--}}
                                        {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--@endif--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('content_hidden')
    <input type="hidden" id="PrimaryKey" data-field="id" value="{{$details->id??'-1'}}">
    <input type="hidden" id="BizType" data-field="BizType" value="DC">
@stop

@section('css')
    {!! public_url('module/master/css/discount.detail.css') !!}
@stop

@section('js')
    {!! public_url('module/master/js/discount.detail.js') !!}
@stop