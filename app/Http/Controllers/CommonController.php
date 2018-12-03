<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input, Session;
use DB;
use Carbon\Carbon;
use App\Http\Requests\CommonSaveRequest;

class CommonController extends Controller
{
    public static function linksession()
    {
        $result = array();
        try {
            $linkInfo = array();
            $from_screenId = Input::get('from_ScreenId');
//            $to_screenId = Input::get('to_ScreenId');
            $parramObj = Input::get('param');

            // save to session
            session(['link-session.' . $from_screenId . '.from_ScreenId' => $from_screenId]);
//            session(['link-session.' . $from_screenId . '.to_ScreenId' => $to_screenId]);
            session(['from_screen' => $from_screenId]);
//            session(['to_screen' => $to_screenId]);

            foreach ($parramObj as $key => $value) {
                session(['link-session.' . $from_screenId . '.' . $key => $value]);
            }
//            print_r(session::get('link-session'));

            $result = array(
                'status' => 'OK',
                'data' => '',
            );
        } catch (\Exception $e) {
            $result = array(
                'status' => 'EX',
                'data' => '',
            );
        }
        return $result;
    }

    public static function sessionAddToCart(Request $request)
    {
//        dd(Session::forget('add-to-cart'));
        $result = array();
        try {
            $cartInfo = Input::get('cart_info');

//            dd($cartInfo);
            $_ProductCode = $cartInfo['ProductCode'];
            if ($request->session()->has('add-to-cart.' . $_ProductCode)) {
                $cur_quantity = Session::get('add-to-cart.' . $_ProductCode . '.' . 'Quantity');
                $cartInfo['Quantity'] = $cur_quantity + 1;
                $cartInfo['Amount'] = ($cur_quantity + 1) * $cartInfo['UnitPrice'];
                Session::forget('add-to-cart.' . $_ProductCode);
                foreach ($cartInfo as $key => $value) {
                    session(['add-to-cart.' . $_ProductCode . '.' . $key => $value]);
                }
            } else {
                foreach ($cartInfo as $key => $value) {
                    session(['add-to-cart.' . $_ProductCode . '.' . $key => $value]);
                }
            }

            $result = array(
                'status' => 'OK',
                'data' => Session::get('add-to-cart'),
            );
        } catch (\Exception $e) {
            $result = array(
                'status' => 'EX',
                'data' => '',
            );
        }
        return $result;
    }

    public function delete(Request $request)
    {
        $_id_lists = $request->get('id_lists');

        try {
            $url_path = explode('/', $request->path())[1] ?? '';
            $cmd = command_key($url_path)['ctorArg1'] ?? '';

//            DB::connection()->enableQueryLog();
            if (sizeof($_id_lists) == 1) {
                DB::table($cmd)->where('id', $_id_lists[0])->update(['IsActive' => '0']);
            } else {
                DB::table($cmd)->whereIn('id', $_id_lists)->update(['IsActive' => '0']);
            }


//            $queries = DB::getQueryLog();
//            dd($queries);
            $result = array(
                'status' => '200',
                'data' => 'Success delete data',
            );

        } catch (\Exception $e) {

            $result = array(
                'status' => '203',
                'data' => $e,
            );
        }

        return response()->json($result);
    }

//    Process for common screen
    public function listData(Request $request)
    {

//        DB::connection()->enableQueryLog();
        $url_path = explode('/', $request->path())[1] ?? '';
        $cmd = command_key($url_path)['ctorArg1'] ?? '';
        $orderBy = command_key($url_path)['orderBy'] ?? array();

        $ctorArgs = array(array('IsActive', '=', 1));
        if (isset(command_key($url_path)['ctorArgs'])) {
            array_push($ctorArgs, command_key($url_path)['ctorArgs']);
        }

        $details = DB::table($cmd)->where($ctorArgs);//
        foreach ($orderBy as $key => $value) {
            $details->orderBy($key, $value);

        }
//        dd(DB::getQueryLog());
        $data['details'] = $details->paginate(20);
        return view($url_path . '.index', $data);
    }

    public function save(CommonSaveRequest $request)
    {
        DB::beginTransaction();
        try {
            $form_data = json_decode($request->form_data, true);
            $url_path = explode('/', $request->path())[1] ?? '';
            $cmd = command_key($url_path)['ctorArg1'] ?? '';
            if ($cmd != '') {
                $primaryKey = $form_data['id'] ?? -1;
                $data = array_filter($form_data, function ($value) {
                    return ($value !== '' && $value !== null);
                });

                if ($primaryKey == '-1') {
                    $primaryKey = DB::table($cmd)->insertGetId(array_except($data, ['id']));

                    $result = array(
                        'status' => '200',
                        'data' => 'Success insert data',
                    );
                } else {
                    DB::table($cmd)
                        ->where('id', $primaryKey)
                        ->update($data);

                    $result = array(
                        'status' => '200',
                        'data' => 'Success update data',
                    );
                }

//                upload files
                $upload_files = $request->file;
                if (!(empty($upload_files))) {
                    $this->uploadFiles($upload_files, '_' . $cmd, $primaryKey);

                    $file_datafield = $request->file_datafield ?? '';

                    if ($file_datafield != '') {
                        DB::table($cmd)
                            ->where('id', $primaryKey)
                            ->update([$file_datafield => ('/images/_' . $cmd . '/') . $primaryKey . '.' . $upload_files[0]->getClientOriginalExtension()]);
                    }
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

    public function saveMultiDatatable(Request $request)
    {
        DB::beginTransaction();
        try {
            $primaryKey = $request->ParentData['id'] ?? -1;
            $data = array_filter($request->ParentData, function ($value) {
                return ($value !== '' && $value !== null);
            });

            $detail_data = array_filter($request->DetailData, function ($value) {
                return ($value !== '' && $value !== null);
            });


            if ($primaryKey == '-1') {
                $primaryKey = DB::table('f_bizdoc')->insertGetId(array_except($data, ['id']));

                for ($i = 0; $i < count($detail_data); $i++) {
                    $detail_data[$i]['BizDocId'] = $primaryKey;
                }

                DB::table('f_quotation')->insert($detail_data);

                $result = array(
                    'status' => '200',
                    'data' => 'Success insert data',
                );
            } else {
                DB::table('f_bizdoc')
                    ->where('id', $primaryKey)
                    ->update($data);

                for ($i = 0; $i < count($detail_data); $i++) {
                    $detail_data[$i]['BizDocId'] = $primaryKey;
                }

                DB::table('f_quotation')->where('BizDocId', '=', $primaryKey)->delete();
                DB::table('f_quotation')->insert($detail_data);

                $result = array(
                    'status' => '200',
                    'data' => 'Success update data',
                );
            }
            DB::commit();


        } catch (\Exception $e) {
            DB::rollback();
            $result = array(
                'status' => '203',
                'data' => $e,
            );
        }

        return response()->json($result);
    }

    //    End process for common screen

    public function uploadMultipleFiles(Request $request)
    {
        $result = '';
        try {
            if ($request->file) {
                $files = $request->file;
                foreach ($files as $file) {
                    $file->move(public_path('images/_upload_products/2'), $file->getClientOriginalName());
                }
                $result = array(
                    'status' => '200',
                    'data' => 'Upload files success',
                );
            }
        } catch (\Exception $e) {
            $result = array(
                'status' => '203',
                'data' => $e,
            );
        }
        return response()->json($result);
    }

    /**
     * @Notes: Parent key must field [id] of table
     * @param Request $request
     * @param $cmd
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveMultiple(Request $request, $cmd)
    {
        $ctorArg1 = command_key($cmd)['ctorArg1'];
        $tableDetail = command_key($cmd)['tableDetail'];
        $keyDetail = command_key($cmd)['keyDetail'];


        DB::beginTransaction();
        try {
            $primaryKey = $request->ParentData['id'] ?? -1;
            $data = array_filter($request->ParentData, function ($value) {
                return ($value !== '' && $value !== null);
            });

            $detail_data = array_filter($request->DetailData, function ($value) {
                return ($value !== '' && $value !== null);
            });

            //With sale voucher
            if ($cmd == 'sale') {
                $_timeNow = Carbon::now()->format('Y-m-d');
                $_countRec = DB::table($ctorArg1)->where('DocDate', $_timeNow)->count();
                $data['CustomerCode'] = 'GUEST';
                $data['DocDate'] = $_timeNow;
                $data['DocNo'] = Carbon::now()->format('Ymd') . substr('0000' . ($_countRec + 1), -4, 4);
            }

            if ($primaryKey == '-1') {
                $primaryKey = DB::table($ctorArg1)->insertGetId(array_except($data, ['id']));

                for ($i = 0; $i < count($detail_data); $i++) {
                    $detail_data[$i][$keyDetail] = $primaryKey;
                }

                DB::table($tableDetail)->insert($detail_data);

                $result = array(
                    'status' => '200',
                    'data' => 'Success insert data',
                );
            } else {
                DB::table($ctorArg1)
                    ->where('id', $primaryKey)
                    ->update($data);

                for ($i = 0; $i < count($detail_data); $i++) {
                    $detail_data[$i][$keyDetail] = $primaryKey;
                }

                DB::table($tableDetail)->where($keyDetail, '=', $primaryKey)->delete();
                DB::table($tableDetail)->insert($detail_data);

                $result = array(
                    'status' => '200',
                    'data' => 'Success update data',
                );
            }

            Session::forget('add-to-cart');
            DB::commit();


        } catch (\Exception $e) {
            DB::rollback();
            $result = array(
                'status' => '203',
                'data' => $e,
            );
        }

        return response()->json($result);
    }

    public function removeImage(Request $request)
    {
        $path = $request->img_path;

        if (file_exists(public_path($path))) {
            unlink(public_path($path));
            $result = array(
                'status' => '200',
                'data' => $path . ' has been removed.',
            );

        } else {
            $result = array(
                'status' => '203',
                'data' => 'File does not exists',
            );

        }
        return response()->json($result);
    }

    public function uploadFiles($files, $path_folder, $primary_key)
    {
        if ($files) {
            foreach ($files as $file) {
                $file->move(public_path('images/' . $path_folder . '/'), $primary_key . '.' . $file->getClientOriginalExtension());
            }
        }
    }

    public function forgetSession(Request $request)
    {
        $result = array();
        try {
            $session_key = $request->from_ScreenId;

            if ($request->session()->get('link-session.' . $session_key)) {
                $request->session()->forget('link-session.' . $session_key);
            }

            $result = array(
                'status' => 'OK',
                'data' => '',
            );
        } catch (\Exception $e) {
            $result = array(
                'status' => 'EX',
                'data' => '',
            );
        }
        return $result;
    }
}


