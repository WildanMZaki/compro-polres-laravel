<?php

function sluger($str)
{
    $r = str_replace(' ', '-', strtolower($str));
    if (preg_match('/\//', $r)) {
        $r = str_replace('/', '--', $r);
    }
    return $r;
}

function time_passed($ts) : string {
    $t = explode(' ', $ts);
    $dates = explode('-', $t[0]);
    $times = explode(':', $t[1]);
    $pass = mktime($times[0], $times[1], $times[2], $dates[1], $dates[2], $dates[0]);
    $time_passed = time() - $pass;
    // Start Converting
    if ($time_passed < 60) {
        return $time_passed.' detik yang lalu';
    } else if ($time_passed < 3600) {
        return floor($time_passed/60).' menit yang lalu';
    } else if ($time_passed < 86400) {
        return floor($time_passed/3600).' jam yang lalu';
    } else if ($time_passed < 604800) {
        return floor($time_passed/86400).' hari yang lalu';
    } else if ($time_passed < 2592000) {
        return 'Sekitar '.floor($time_passed/604800).' minggu yang lalu';
    } else {
        return date_convert($ts);
    }

}

function date_convert($ts)
{
    $months = [
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
        'Desember',
    ];

    $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jum\'at',
        'Saturday' => 'Sabtu'
    ];

    $t = explode(' ', $ts);
    $dates = explode('-', $t[0]);
    $times = explode(':', $t[1]);
    $day_key = date('l', mktime($times[0], $times[1], $times[2], $dates[1], $dates[2], $dates[0]));
    $day = $days[$day_key];
    return $day.', '.$dates[2].' '.$months[intval($dates[1])-1].' '.$dates[0];
}
