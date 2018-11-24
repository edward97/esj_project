<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// random string
function rd_code($x) {
    $data = '';
    $chr = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $chr_length = strlen($chr);

    for ($i=0; $i < $x; $i++) { 
        $data .= $chr[rand(0, $chr_length-1)];
    }
    return $data;
}

// filter data
function dt_filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

// active link
function at_link($path, $x = 'class="active"') {
    $CI =& get_instance();
    $uri_string = $CI->uri->uri_string();

    if ($path === '/' && ($CI->uri->total_segments() === 0)) {
        $data = 'class="active"';
    } else {
        $data = ($uri_string === $path) ? $x : '';
    }
    return $data;
}

// get uri
function gt_uri($x) {
    $CI =& get_instance();
    $uri = $CI->uri->segment($x);
    return $uri;
}

// get current session theme
function ct_theme($x, $y, $z = 'selected') {
    $CI =& get_instance();

    if ($x === 'nav_color') {
        $curr_color = $CI->session->userdata('ses_color');
        $data = ($y === $curr_color) ? $z : '';
    }
    elseif ($x === 'nav_bg') {
        $curr_bg = $CI->session->userdata('ses_bg');
        $data = ($y === $curr_bg) ? $z : '';
    } else {
        $z = 'checked';
        
        $curr_status = $CI->session->userdata('ses_status');
        $data = ($y == $curr_status) ? $z : '';
    }
    return $data;
}

// change display format date
function d_date($x) {
    $data = mdate("%d-%M-%Y %H:%i", strtotime($x));
    return $data;
}

// change insert format date
function i_date($x) {
    $data = mdate("%Y-%m-%d %H:%i", strtotime($x));
    return $data;
}