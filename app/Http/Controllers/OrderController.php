<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input, Session;
use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }

    //getLanguage
    public function getLanguage()
    {
        return view('selforder.language');
    }

    //getCatalog
    public function getCatalog()
    {
        $data['catalogs'] = DB::table('m_catalogs')->where('IsActive', '1')->get();

        return view('selforder.catalogs', $data);
    }

    public function index(Request $request)
    {
        $perPage = 20;
        $catg_code = $request->catg ?? '';
        $data['arrColors'] = array('cf5a3f', 'db5233', 'e44c2a');

        $ctorArgs = array(array('IsActive', '=', 1));
        if ($catg_code != '') {
            array_push($ctorArgs, ['CatalogCode', '=', $catg_code]);
        }

        $catg_name = DB::table('m_catalogs')->where('IsActive', '1')->where('Code', $catg_code)->select('Name')->get()->first() ?? '';
        $data['catalogs'] = DB::table('m_catalogs')->where('IsActive', '1')->get();

        $resProc = DB::select('call sp_GetProducts(?, ?)',
            array($request->get('catg', ''), Carbon::now()->format('Y-m-d'))

        );

        $list = collect($resProc);

        $pageList = $this->paginate($list, $perPage, $request->get('page', '1'));

        $data['products'] = $pageList;
        $data['catg_name'] = $catg_name->Name ?? 'Nổi bật';

//        $_linkUrl = str_replace($request->root(), "", $request->fullUrl());

//        dump(array($pageList->count(), $request->fullUrl() . str_replace("/?", "&", $pageList->nextPageUrl())
//        , $pageList->currentPage()
//        , $pageList->firstItem()
//        , $pageList->hasMorePages()
//        , $pageList->lastItem()
//        , $pageList->lastPage()
//        , $pageList->nextPageUrl()
//        , $pageList->perPage()
//        , $pageList->previousPageUrl()
//        , $pageList->total()));
//        dd(1);
        //For cart
        $session_cart = Session::get('add-to-cart') ?? array();
        $_total_cart_quan = array_sum(array_pluck($session_cart, 'Quantity')) ?? 0;
        $_total_cart_amount = array_sum(array_pluck($session_cart, 'Amount')) ?? 0;

        $data['total_cart_quan'] = $_total_cart_quan;
        $data['total_cart_amount'] = $_total_cart_amount;

        return view('selforder.order', $data);
    }

    //getYourCart
    public function getYourCart(Request $request)
    {

//        dd(Session::forget('add-to-cart'));
        $catg_code = $request->catg ?? '';
        $data['arrColors'] = array('cf5a3f', 'db5233', 'e44c2a');

        $ctorArgs = array(array('IsActive', '=', 1));
        if ($catg_code != '') {
            array_push($ctorArgs, ['CatalogCode', '=', $catg_code]);
        }

        $data['catalogs'] = DB::table('m_catalogs')->where('IsActive', '1')->get();

        $session_cart = Session::get('add-to-cart') ?? array();

        $_total_cart_quan = array_sum(array_pluck($session_cart, 'Quantity')) ?? 0;
        $_total_cart_amount = array_sum(array_pluck($session_cart, 'Amount')) ?? 0;

        $data['total_cart_quan'] = $_total_cart_quan;
        $data['total_cart_amount'] = $_total_cart_amount;
        $data['products'] = $session_cart;

        return view('your_cart', $data);
    }
}

