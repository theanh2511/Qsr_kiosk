<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Input, Session;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    protected $screen = 'm_products';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listData()
    {
        $product = DB::table($this->screen)->where('IsActive', '1')->simplePaginate(9);

        $data['product'] = $product;
        return view('product.index', $data);
    }


    public function getDetail(Request $request)
    {
        $arrImgs = [];
        $primary_key = -1;
        $catalogs = DB::table('m_catalogs')->where('IsActive', '1')->select('Code', 'Name')->get();

        if ($request->session()->get('link-session')) {
            $_scr_session = $request->session()->get('link-session');
            $primary_key = $_scr_session[$this->screen]["init_data"]["primary_key"] ?? -1;
        }

        $product_detail = DB::table($this->screen)->where('id', $primary_key)->first();
        $child_product = DB::table('m_product_detail')->where('ParentProductCode', $product_detail->Code)->get();

        //process show images
        $filesInFolder = [];
        if (file_exists('images\_upload_products\\' . $primary_key)) {
            $filesInFolder = \File::files('images\_upload_products\\' . $primary_key);
        }

        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            $arrImgs[] = [
                'file_name' => $file['basename'],
                'file_path' => "\\" . $file['dirname'] . "\\" . $file['basename']
            ];
        }
        //end: process show images
        $data['product'] = $product_detail;
        $data['catalogs'] = $catalogs;
        $data['product_images'] = $arrImgs;
        $data['child_product'] = $child_product;

        return view('product.detail', $data);
    }

    public function getViewer(Request $request, $primary_key = -1)
    {
//        $primary_key = 1;

        $product_detail = DB::table($this->screen)->where('id', $primary_key)->first();
        $data['catalogs'] = DB::table('m_catalogs')->where('IsActive', '1')->get();
        $arrImgs = array();

        if (file_exists('images\_upload_products\\' . $primary_key)) {
            $filesInFolder = \File::files('images\_upload_products\\' . $primary_key);

            foreach ($filesInFolder as $path) {
                $file = pathinfo($path);
                array_push($arrImgs, "\\" . $file['dirname'] . "\\" . $file['basename']);
            }
        }


        $data['product'] = $product_detail;
        $data['product_images'] = $arrImgs;

        //For cart
        $session_cart = Session::get('add-to-cart') ?? array();
        $_total_cart_quan = array_sum(array_pluck($session_cart, 'Quantity')) ?? 0;
        $_total_cart_amount = array_sum(array_pluck($session_cart, 'Amount')) ?? 0;

        $data['total_cart_quan'] = $_total_cart_quan;
        $data['total_cart_amount'] = $_total_cart_amount;

        return view('product.productview', $data);
    }

//    public function delete(Request $request)
//    {
//        $_id_lists = $request->id_lists;
//
//        try {
//            DB::table($this->screen)->whereIn('id', $_id_lists)->update(['IsActive' => 0]);
//            $result = array(
//                'status' => '200',
//                'data' => 'Success delete data',
//            );
//
//        } catch (\Exception $e) {
//            $result = array(
//                'status' => '203',
//                'data' => $e,
//            );
//        }
//
//        return response()->json($result);
//    }
//
    public function save(Request $request)
    {

        DB::beginTransaction();
        try {
            $form_data = json_decode($request->form_data, true);
            $data = $form_data['ParentData'];
//            $detail_data = $form_data['DetailData'];

            if ($this->screen != '') {
                $primaryKey = $data['id'] ?? -1;
                $data = array_filter($data, function ($value) {
                    return ($value !== '' && $value !== null);
                });

                $detail_data = array_filter($form_data['DetailData'], function ($value) {
                    return ($value !== '' && $value !== null);
                });

                if ($primaryKey == '-1') {
                    $primaryKey = DB::table($this->screen)->insertGetId(array_except($data, ['id']));

                    DB::table('m_product_detail')->insert(array_except($detail_data, ['id']));

                    $result = array(
                        'status' => '200',
                        'data' => 'Success insert data',
                    );
                } else {
                    DB::table($this->screen)
                        ->where('id', $primaryKey)
                        ->update($data);

                    DB::table('m_product_detail')->where('ParentProductCode', '=', $data['Code'])->delete();
                    DB::table('m_product_detail')->insert(array_except($detail_data, ['id']));

                    $result = array(
                        'status' => '200',
                        'data' => 'Success update data',
                    );
                }

//                upload files
                $upload_files = $request->file;
                if (!(empty($upload_files))) {
                    $this->uploadFiles($upload_files, $primaryKey);

                    DB::table($this->screen)
                        ->where('id', $primaryKey)
                        ->update(['ImageUrl' => ('/images/_upload_products/' . $primaryKey . '/') . $upload_files[0]->getClientOriginalName()]);
                }

                DB::commit();
            } else {
                DB::rollback();
                $result = array(
                    'status' => '202',
                    'data' => 'Invalid command key. Please contact the system administrator.',
                );
            }

        } catch (\Exception $e) {
            DB::rollback();
            $result = array(
                'status' => '203',
                'data' => $e,
            );
        }

        return response()->json($result);
    }

    public function uploadFiles($files, $product_id)
    {
        if ($files) {
            foreach ($files as $file) {
                $file->move(public_path('images/_upload_products/' . $product_id), $file->getClientOriginalName());
            }
        }
    }
}

