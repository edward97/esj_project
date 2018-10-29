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
