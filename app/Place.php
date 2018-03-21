<?php

namespace App;

class Place{

    public $id;
    public $name;
    public $place_id;
    public $icon;
    public $location;

    public function __construct($data){
        $this->id = $data->id;
        $this->name = $data->name;
        $this->place_id = $data->place_id;
        $this->icon = $data->icon;
        $this->location = [
            'lat' => $data->geometry->location->lat,
            'lng' => $data->geometry->location->lng
        ];
    }

}