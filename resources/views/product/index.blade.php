{{-- resources/views/admin/dashboard.blade.php --}}

{{--@extends('layouts.main')--}}
@extends('adminlte::page')

@section('title')
    {{ trans('master_product.screen-title-list') }}
@endsection

@section('content_header')
    <span class="text-header">{{ trans('master_product.screen-title-list') }}</span>
    <div class="btn-group pull-right">
        <button type="button" id="btn-search" class="btn btn-primary">{{ trans('system.btn-search') }}</button>
        <button type="button" id="btn-add-new" class="btn btn-primary">{{ trans('system.btn-add-new') }}</button>
        <button type="button" id="btn-edit" class="btn btn-primary">{{ trans('system.btn-edit') }}</button>
        <button type="button" id="btn-delete" class="btn btn-primary">{{ trans('system.btn-delete') }}</button>
    </div>
@stop

@section('content')

    <div class="row form-horizontal">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-1 col-md-1-cus col-sm-1 col-xs-12 control-label">{{ trans('master_product.name') }}</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="tel" class=" form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
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
                                <th class="text-center" width="10%">{{ trans('master_product.UnitCost') }}</th>
                                <th class="text-center" width="10%">{{ trans('master_product.UnitPrice') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $item)
                                <tr class="" primary-key="{{$item->id}}">
                                    <td class="text-center">
                                        <input type="checkbox" class="check-all" primary-key="{{$item->id}}">
                                    </td>
                                    <td class="text-center">{{$item->Code}}</td>
                                    <td>{{$item->Name}}</td>
                                    <td class="text-left">{{$item->Unit}}</td>
                                    <td class="text-right">{{formatNumber($item->UnitCost)}}</td>
                                    <td class="text-right">{{formatNumber($item->UnitPrice)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="div-pagination text-right" style="display: inline-block;float: right;">
                        <nav aria-label="Page navigation">
                            {{ $product->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {!! public_url('module/master/css/product.search.css') !!}
@stop

@section('js')
    {!! public_url('module/master/js/product.search.js') !!}
@stop