<?php

function sluger($str)
{
    return str_replace(' ', '-', strtolower($str));
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
