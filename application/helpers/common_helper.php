<?php
/**
 * function public_url
 * @var $url
 * @return string 
 * path to public folder
 */

function public_url($url='') {
    return base_url('public/'.$url);
}

function printData($list,$exit=true){
    echo "<pre>";
    print_r($list);
    if($exit){
        die();
    }
}
