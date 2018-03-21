<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\APIResponse;
use App\Place;
use App\DetailedPlace;

use App\Services\PlacesService;

class PlacesController extends Controller
{

    public function search(Request $request){
        $response = new APIResponse();

        $text = $request->input("text");
        if(empty($text)){
            $response->setMessage("Please enter a text to search for",400);
            return $response->getResult();
        }

        $data = PlacesService::textSearch($text);
        
        if($data['code'] == 200){
            foreach($data['data'] as $result){
                $responseData[] = new Place($result);
            }
            $response->data = $responseData;
        }

        $response->setMessage($data['message'],$data['code']);

        return $response->getResult();
    }

    public function details($place_id){
        $response = new APIResponse();

        $data = PlacesService::details($place_id);
        if($data['code'] == 200){
            $response->data = new DetailedPlace($data['data']);
        }

        $response->setMessage($data['message'],$data['code']);

        return $response->getResult();
    }
}
