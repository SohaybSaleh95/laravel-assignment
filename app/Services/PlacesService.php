<?php

namespace App\Services;

class PlacesService{
    public static $API_KEY = 'AIzaSyCf_biU7X2nYveQHqd98k6QukGm8vVHP6w';
    public static $url = "https://maps.googleapis.com/maps/api/place";

    public static function textSearch($text){
        $url = self::$url."/textsearch/json?key=".self::$API_KEY."&query=".$text;

        return self::handleMessage(HttpService::get($url));
    }

    public static function details($place_id){
        $url = self::$url."/details/json?key=".self::$API_KEY."&placeid=".$place_id;

        return self::handleMessage(HttpService::get($url));
    }

    public static function handleMessage($data){
        $response = [
            'code' => 200,
            'message' => 'The request was completed successfully!',
            'data' => []
        ];

        if($data->status == "OK"){
            if(isset($data->results)){
                $response['data'] = $data->results;
            }else{
                $response['data'] = $data->result;
            }

        }else if($data->status == "ZERO_RESULTS"){
            
            $response['message'] = "No Results were found";
            $response['code'] = 404;

        }else if($data->status == "OVER_QUERY_LIMIT" || $data->status == "INVALID_REQUEST"){
            
            $response['message'] = "Please enter another search query";
            $response['code'] = 400;

        }else if($data->status == "REQUEST_DENIED"){
            
            $response['message'] = "Request Denied";
            $response['code'] = 403;

        }else if($data->status == "UNKNOWN_ERROR"){
        
            $response['message'] = "Internal Server Error";
            $response['code'] = 500;

        }

        return $response;
    }
}