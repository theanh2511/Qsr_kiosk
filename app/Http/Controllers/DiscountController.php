<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DiscountController extends Controller
{
    protected $screen = 'f_discount';

    public function getDetail(Request $request)
    {
        $primary_key = -1;

        if ($request->session()->get('link-session')) {
            $_scr_session = $request->session()->pull('link-session');
            $primary_key = $_scr_session[$this->screen]["init_data"]["primary_key"] ?? -1;
        }

        $details = DB::table('f_bizdoc')->where('id', $primary_key)->first();
        $bizdoc_detail = DB::table('f_discount')
            ->where([
                ['BizDocId', '=', $primary_key],
                ['IsActive', '=', '1'],
            ])->get();

        $data['details'] = $details;
        $data['bizdoc_detail'] = $bizdoc_detail;
        return view('discount.detail', $data);
    }
}
