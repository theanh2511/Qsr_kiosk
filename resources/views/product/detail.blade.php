{{-- resources/views/admin/dashboard.blade.php --}}

{{--@extends('layouts.main')--}}
@extends('adminlte::page')

@section('title')
    {{ trans('master_product.screen-title-detail') }}
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
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Code') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input value="{{$product->Code??''}}" type="text" class="form-control required key-input"
                                   data-field="Code">
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.name') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" value="{{$product->Name??''}}" class=" form-control required"
                                   placeholder="" data-field="Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Unit') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input value="{{$product->Unit??''}}" id="unit" type="text" class=" form-control"
                                   data-field="Unit">
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.CatalogCode') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="catalog_code" class="form-control" data-field="CatalogCode">
                                <option value="">---------------------</option>
                                @foreach($catalogs as $catg)
                                    <option value="{{$catg->Code??''}}" {{($product->CatalogCode??'')==($catg->Code??'')?'selected':''}}>{{$catg->Name??''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.UnitCost') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input value="{{formatNumber($product->UnitCost??'0')}}" type="text" id="unit_cost"
                                   class="form-control numeric money" maxlength="15"
                                   real_len="12" decimal_len="0" data-field="UnitCost">
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.UnitPrice') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input value="{{formatNumber($product->UnitPrice??'0')}}" type="text" id="unit_price"
                                   class="form-control numeric money" maxlength="15" readonly
                                   real_len="12" decimal_len="0" data-field="UnitPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.ProductInfo') }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea type="textarea" class="form-control" rows="5" id="ProductInfo"
                                  data-field="ProductInfo">{{$product->ProductInfo??''}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Description') }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea type="textarea" class="form-control" rows="5" id="Description"
                                  data-field="Description">{{$product->Description??''}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.MoreImages') }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="file" id="upload_imgs" class="form-control" name="file[]" multiple/>
                        </div>
                    </div>

                    {{--hastags--}}
                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Rank') }}</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input value="{{formatNumber($product->Rank??'0')}}" type="text" id="Rank"
                                   class="form-control numeric money" maxlength="3"
                                   real_len="3" decimal_len="0" data-field="Rank">
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.IsGetChildPrice') }}</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input value="" type="checkbox" data-field="IsGetChildPrice" class=""/>
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.StopBusiness') }}</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input value="" type="checkbox" data-field="StopBusiness" class=""/>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="tbl-explorer">
                            <thead>
                            <tr class="col-table-header text-center">
                                <th class="text-center" colspan="3">{{ trans('master_product.ListOfImages') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product_images as $prod_img)
                                <tr>
                                    <td class="w-40px text-center">
                                        <img width="40px" height="40px" alt="product-single"
                                             src="{{$prod_img['file_path']}}" class="td-img"
                                             style="height: 40px;"/>
                                    </td>
                                    <td class="text-overflow" style="max-width: 150px;"
                                        title="{{$prod_img['file_name']}}">{{$prod_img['file_name']}}</td>
                                    <td class="w-40px text-center">
                                        <i class="fa fa-minus-circle text-danger cursor-pointer remove-img"
                                           aria-hidden="true"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    {{--List of product detail--}}
                    <div class="form-group">
                        <table class="table table-bordered table-hover table-striped" id="tbl-detail">
                            <thead>
                            <tr class="col-table-header text-center">
                                <th class="w-45px text-center">
                                    <i id="btn-add-row" class="fa fa-plus text-success-700 cursor-pointer"
                                       aria-hidden="true"></i>
                                </th>
                                <th class="text-center" width="20%">{{ trans('master_product.Code') }}</th>
                                <th class="text-center">{{ trans('master_product.Name') }}</th>
                                <th class="text-center" width="10%">{{ trans('master_product.Unit') }}</th>
                                <th class="text-center" width="10%">{{ trans('master_product.UnitPrice') }}</th>
                                <th class="text-center" width="10%">{{ trans('master_product.Quantity') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="">
                                <td class="w-40px text-left">
                                    <i class="fa fa-minus-circle text-danger cursor-pointer remove-row"
                                       aria-hidden="true"></i>
                                    <span class="zstt">1</span>
                                    <span class="detail_primary_key hidden"></span>
                                </td>
                                <td class="text-center" width="20%">
                                    <div class="input-group">
                                        <input type="text" class="form-control product-code search-input"
                                               placeholder="Product code"/>
                                        <span class="input-group-addon cursor-pointer btn-search"><i
                                                    class="glyphicon glyphicon-search"></i></span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control product-name" disabled/>
                                </td>
                                <td class="text-center" width="10%">
                                    <input type="text" class="form-control product-unit" value="" disabled/>
                                </td>
                                <td class="text-center" width="20%">
                                    <input value="" type="text" disabled
                                           class="form-control numeric money product-unitprice"
                                           maxlength="15" real_len="12" decimal_len="0">
                                </td>

                                <td class="text-center" width="10%">
                                    <input value="" type="text" id="quantity"
                                           class="form-control numeric money quantity"
                                           maxlength="15" real_len="12" decimal_len="0">

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{--Modal popup for search product--}}
                <div class="modal fade" id="modalProduct" role="dialog" style="margin-top: 150px;">
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
    <input type="hidden" id="PrimaryKey" data-field="id" value="{{$product->id??'-1'}}">
    <input type="hidden" id="ParentId" data-field="ParentId" value="1">
@stop

@section('css')
    {!! public_url('plugins/summernote/summernote.css') !!}
    {!! public_url('module/master/css/product.detail.css') !!}
@stop

@section('js')
    {!! public_url('plugins/summernote/summernote.js') !!}
    {!! public_url('module/master/js/product.detail.js') !!}
@stop