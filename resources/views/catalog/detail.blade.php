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
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Code') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input value="{{$catalog->Code??''}}" type="text" class=" form-control required"
                                   data-field="Code">
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Name') }}</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" value="{{$catalog->Name??''}}" class=" form-control required"
                                   placeholder=""
                                   data-field="Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.Description') }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea type="textarea" class="form-control" rows="5" id="Description"
                                  data-field="Description">{{$catalog->Description??''}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12 control-label">{{ trans('master_product.MoreImages') }}</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="file" id="upload_imgs" data-field class="form-control" name="file"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <img width="100%" alt="product-single"
                         src="{{$catalog->ImageUrl??''}}" style="max-width: 260px;"/>
                </div>
            </div>
        </div>
    </div>

@stop

@section('content_hidden')
    <input type="hidden" id="PrimaryKey" data-field="id" value="{{$catalog->id??'-1'}}">
    <input type="hidden" id="ParentId" data-field="ParentId" value="1">
@stop

@section('css')
    {!! public_url('module/master/css/catalog.detail.css') !!}
@stop

@section('js')
    {!! public_url('module/master/js/catalog.detail.js') !!}
@stop