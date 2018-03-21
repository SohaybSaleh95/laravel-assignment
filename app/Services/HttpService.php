<?php

namespace App\Services;

class HttpService{

    public static function get($url){
        //$url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?key=AIzaSyCf_biU7X2nYveQHqd98k6QukGm8vVHP6&query=palestine';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec ($ch);
        $info = curl_getinfo($ch);
        curl_close ($ch);
        return json_decode($output);
    }

}