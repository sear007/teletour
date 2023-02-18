<?php
use Illuminate\Support\Str;


if(!function_exists('slug')){
    function slug($name){
        return Str::slug($name);
    }
}

if(!function_exists('getImagesUrl')){
    function getImagesUrl($data){
        $images = [];
        foreach($data as $key => $image){
            $images[$key] = $image->filename;
        }
        return $images;
    }
}

if(!function_exists('limitString')){
    function limitString($strings = '', $limit = 100){
        return Str::limit($strings, $limit);
    }
}

if(!function_exists('price')){
    function price($price = 0, $currency = 'usd'){
     switch($currency){
        case "usd": return "$" .number_format($price, 2);
     }   
    }
}