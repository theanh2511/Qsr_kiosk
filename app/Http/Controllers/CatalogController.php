<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CatalogController extends Controller
{
    protected $screen = 'm_catalogs';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listData()
    {
        $catalog = DB::table($this->screen)->where('IsActive', '1')->paginate(15);

        $data['catalog'] = $catalog;
        return view('catalog.index', $data);
    }

    public function getDetail(Request $request)
    {
        $primary_key = -1;

        if ($request->session()->get('link-session')) {
            $_scr_session = $request->session()->get('link-session');
            $primary_key = $_scr_session[$this->screen]["init_data"]["primary_key"] ?? -1;
        }

        $catalog_detail = DB::table($this->screen)->where('id', $primary_key)->first();

        $data['catalog'] = $catalog_detail;
        return view('catalog.detail', $data);
    }
}
