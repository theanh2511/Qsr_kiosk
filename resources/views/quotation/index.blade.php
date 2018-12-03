{{-- resources/views/admin/dashboard.blade.php --}}

{{--@extends('layouts.main')--}}
@extends('adminlte::page')

@section('title')
    {{ trans('master_quotation.screen-title-list') }}
@endsection

@section('content_header')
    <span class="text-header">{{ trans('master_quotation.screen-title-list') }}</span>
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
                    <label class="col-md-1 col-md-1-cus col-sm-1 col-xs-12 control-label">{{ trans('master_quotation.DocNo') }}</label>
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
                                <th class="text-center" width="10%">{{ trans('master_quotation.DocNo') }}</th>
                                <th class="text-center" width="10%">{{ trans('master_quotation.DocDate') }}</th>
                                <th class="text-center" width="12%">{{ trans('master_quotation.EffectiveDate_Fr') }}</th>
                                <th class="text-center" width="12%">{{ trans('master_quotation.EffectiveDate_To') }}</th>
                                <th class="text-center" width="">{{ trans('master_quotation.Description') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $item)
                                <tr primary-key="{{$item->id}}">
                                    <td class="text-center">
                                        <input type="checkbox" class="check-all" primary-key="{{$item->id}}">
                                    </td>
                                    <td class="text-left" width="10%">{{$item->DocNo}}</td>
                                    <td class="text-center" width="10%">{{ \Carbon\Carbon::parse($item->DocDate??'')->format('d/m/Y')}}</td>
                                    <td class="text-center" width="10%">{{ \Carbon\Carbon::parse($item->EffectiveDate_Fr??'')->format('d/m/Y')}}</td>
                                    <td class="text-center" width="10%">{{ \Carbon\Carbon::parse($item->EffectiveDate_To??'')->format('d/m/Y')}}</td>
                                    <td class="text-left">{{$item->Description}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="div-pagination text-right" style="display: inline-block;float: right;">
                        <nav aria-label="Page navigation">
                            {{ $details->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {!! public_url('module/master/css/quotation.search.css') !!}
@stop

@section('js')
    {!! public_url('module/master/js/quotation.search.js') !!}
@stop