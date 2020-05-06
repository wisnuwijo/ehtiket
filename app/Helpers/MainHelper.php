<?php

function formatDate($date)
{
    $explodeDate = explode('-', $date);

    $formattedDate = '';
    if (count($explodeDate) > 0) {
        $time = '';
        $explodeDay = explode(' ', $explodeDate[2]);
        if (count($explodeDay) > 1) {
            $time = $explodeDay[1];
            $day = $explodeDay[0];
        } else {
            $day = $explodeDate[2];
        }

        $monthNumber = $explodeDate[1];
        $year = $explodeDate[0];

        $monthList = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $month = $monthList[($monthNumber - 1)];
        if ($time != '') {
            $formattedDate = $day.' '.$month.' '.$year.', '.$time;
        } else {
            $formattedDate = $day.' '.$month.' '.$year;
        }
    }

    return $formattedDate;
}

function showModules()
{
    $roleId = Auth::user()->role_id;
    $base_url = URL::to('/');
    $url      = url()->current();

    if ($url == url('/')) {
        $app_url = '/';
    } else {
        $get_main_url  = substr($url, strlen($base_url) + 1);
        $detect_slash = strpos($get_main_url, '/');
        if ($detect_slash > 0) {
            $explode_main_url = explode('/', $get_main_url);
            $app_url = $explode_main_url[0];
        } else {
            $app_url = $get_main_url;
        }
    }

    $getModule = DB::table('table_roles_access')
                ->join('table_modules','table_roles_access.module_id','table_modules.id')
                ->where('table_roles_access.role_id',$roleId)
                ->get();

    $sidebar = array();
    if (count($getModule) > 0) {
        foreach ($getModule as $gm) {
            if ($app_url == $gm->module_url) {
                // active menu
                $sidebar[] = '<li class="nav-item active">'.
                                '<a class="nav-link active" href="'.url($gm->module_url).'">'.
                                    '<i class="'.$gm->module_icon.' text-blue"></i> '.$gm->module_name.
                                '</a>'.
                            '</li>';
            } else {
                $sidebar[] = '<li class="nav-item">'.
                                '<a class="nav-link " href="'.url($gm->module_url).'">'.
                                    '<i class="' . $gm->module_icon . ' text-blue"></i> ' . $gm->module_name .
                                '</a>'.
                            '</li>';
            }
        }
    }
    echo implode('',$sidebar);
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function base64url_encode($plainText)
{
    return strtr(base64_encode($plainText), '+/=', '-_,');
}

function base64url_decode($b64Text)
{
    return base64_decode(strtr($b64Text, '-_,', '+/='));
}
