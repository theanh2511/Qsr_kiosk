<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QuotationController extends Controller
{
    protected $screen = 'f_quotation';

    public function getDetail(Request $request)
    {
        $primary_key = -1;

        if ($request->session()->get('link-session')) {
            $_scr_session = $request->session()->pull('link-session');
            $primary_key = $_scr_session[$this->screen]["init_data"]["primary_key"] ?? -1;
        }

        $details = DB::table('f_bizdoc')->where('id', $primary_key)->first();
        $bizdoc_detail = DB::table('f_quotation')
            ->where([
                ['BizDocId', '=', $primary_key],
                ['IsActive', '=', '1'],
            ])->get();

        $data['details'] = $details;
        $data['bizdoc_detail'] = $bizdoc_detail;
        return view('quotation.detail', $data);
    }

    public function search(Request $request)
    {
        $key_search = $request->key_search;

        $product = DB::table('m_products')
            ->where('Name', 'like', '%' . $key_search . '%')
            ->orWhere('Code', 'like', '%' . $key_search . '%')
            ->orWhere('Unit', 'like', '%' . $key_search . '%')
            ->paginate(15);

        $data['product'] = $product;
        return view('custom._search_product', $data);
    }
}
