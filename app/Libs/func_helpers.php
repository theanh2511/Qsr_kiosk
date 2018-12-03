<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

//use Config;

/*
 * Add timestamp version
 */
if (!function_exists('file_cached')) {
    function file_cached($path, $bustQuery = false)
    {
        // Get the full path to the file.
        $realPath = public_path($path);

        if (!file_exists($realPath)) {
            throw new \LogicException("File not found at [{$realPath}]");
        }

        // Get the last updated timestamp of the file.
        $timestamp = filemtime($realPath);

        if (!$bustQuery) {
            // Get the extension of the file.
            $extension = pathinfo($realPath, PATHINFO_EXTENSION);

            // Strip the extension off of the path.
            $stripped = substr($path, 0, -(strlen($extension) + 1));

            // Put the timestamp between the filename and the extension.
            $path = implode('.', array($stripped, $timestamp, $extension));
        } else {
            // Append the timestamp to the path as a query string.
            $path .= '?v=' . $timestamp;
        }

        return asset($path);
    }
}
/*
 * Call url file
 */
if (!function_exists('public_url')) {
    function public_url($url, $attributes = null)
    {
        if (file_exists($url)) {
            $attr = '';
            if (!empty($attributes) && is_array($attributes)) {
                foreach ($attributes as $key => $val) {
                    $attr .= $key . '="' . $val . '" ';
                }
            }
            $attr = rtrim($attr);
            if (ends_with($url, '.css')) {
                return '<link rel="stylesheet" href="' . file_cached($url, true) . '" type="text/css" ' . $attr . '>';
            } elseif (ends_with($url, '.js')) {
                return '<script src="' . file_cached($url, true) . '" type="text/javascript" charset="utf-8" ' . $attr . '></script>';
            } else {
                return asset($url);
            }
        }
        $console = 'File:[' . $url . '] not found';
        return "<script>console.log('" . $console . "')</script>";
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number = '', $decimal = 0, $isPercent = 0)
    {
        if ($number == '' || (1 * $number) == 0)
            return '';

        $number = 1 * $number;

        if ($isPercent == '1') {
            $number = $number * 100;
        }

        if (($number - round($number)) != 0) {
            $number = number_format($number, $decimal, '.', ',');
        } else {
            $number = number_format($number, 0, '.', ',');
        }


        return $number;
    }
}

if (!function_exists('initSession')) {
    function initSession($screen, $clear_session = false)
    {
        $screenSession = null;
        $searchFlag = 0;
        $oldConditionSearchHtml = null;
        $back_link = '/system/db001';
        $back_screen = '';
        $back_data = ['back_link' => '/system/db001'];
        $oldPageIndex = 1;
        $oldPageSize = null;
        $search_html = '';
        $is_from_search = '0';
        if (session::has('link-session.' . $screen)) {
            $screenSession = session::get('link-session.' . $screen);
            if (isset($screenSession['init_data']['search_flag'])) {
                $searchFlag = $screenSession['init_data']['search_flag'];
            }
            if (isset($screenSession['init_data']['message_search_condition'])) {
                $oldConditionSearchHtml = $screenSession['init_data']['message_search_condition'];
            }
            if (isset($screenSession['back_data']['search_flag'])) {
                $is_from_search = $screenSession['back_data']['search_flag'];
            }
            if (isset($screenSession['back_data']['message_search_condition'])) {
                $search_html = $screenSession['back_data']['message_search_condition'];
            }
            if (isset($screenSession['init_data']['pageSize'])) {
                $oldPageSize = $screenSession['init_data']['pageSize'];
            }
            if (isset($screenSession['init_data']['pageIndex'])) {
                $oldPageIndex = $screenSession['init_data']['pageIndex'];
            }
            if (isset($screenSession['back_link'])) {
                $back_link = $screenSession['back_link'];
            }
            if (isset($screenSession['back_screen'])) {
                $back_screen = $screenSession['back_screen'];
            }
            if (isset($screenSession['back_data'])) {
                $back_data = $screenSession['back_data'];
                if ($is_from_search == '1')
                    unset($back_data['message_search_condition']);
            }
            if ($clear_session)
                session::forget('link-session.' . $screen);
        }

        return (
        [
            'searchFlag' => $searchFlag
            , 'oldConditionSearchHtml' => $oldConditionSearchHtml
            , 'is_from_search' => $is_from_search
            , 'search_html' => $search_html
            , 'oldPageSize' => $oldPageSize
            , 'oldPageIndex' => $oldPageIndex
            , 'back_link' => $back_link
            , 'back_screen' => $back_screen
            , 'back_data' => json_encode($back_data)
            , 'screen' => $screen
        ]
        );
    }
}


if (!function_exists('command_key')) {
    function command_key($command_key)
    {
        $_libs = [
            'product' => array('ctorArg1' => 'm_products'),
            'catalog' => array('ctorArg1' => 'm_catalogs'),
            'quotation' => array('ctorArg1' => 'f_bizdoc', 'ctorArgs' => array('BizType', '=', 'QT')),
            'discount' => array('ctorArg1' => 'f_bizdoc', 'ctorArgs' => array('BizType', '=', 'DC'), 'tableDetail' => 'f_discount', 'keyDetail' => 'BizDocId'),
            'sale' => array('ctorArg1' => 'f_sales', 'tableDetail' => 'f_sales_detail', 'keyDetail' => 'SaleId', 'orderBy' => array('DocDate' => 'desc', 'DocNo' => 'desc')),
        ];

        return $_libs[$command_key] ?? '';
    }
}