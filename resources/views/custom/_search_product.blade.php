<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id="">
        <thead>
        <tr class="col-table-header text-center">
            {{--<th class="w-40px text-center">--}}
                {{--<input type="checkbox" id="check-all" class="chk-edit">--}}
            {{--</th>--}}
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
        @if(!empty($product))
            @foreach($product as $item)
                <tr class="modal-tr" primary-key="{{$item->id}}">
                    {{--<td class="text-center">--}}
                        {{--<input type="checkbox" class="check-all"--}}
                               {{--primary-key="{{$item->id}}">--}}
                    {{--</td>--}}
                    <td class="text-center product-code">{{$item->Code}}</td>
                    <td class="product-name">{{$item->Name}}</td>
                    <td class="text-left product-unit">{{$item->Unit}}</td>
                    <td class="text-right product-unitcost">{{formatNumber($item->UnitCost)}}</td>
                    <td class="text-right product-unitprice">{{formatNumber($item->UnitPrice)}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>