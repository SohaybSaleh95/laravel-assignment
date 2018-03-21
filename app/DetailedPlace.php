<?php

namespace App;

class DetailedPlace{

    public $address_components;
    public $full_address = "";
    public $location;
    public $icon;
    public $id;
    public $phone_number;
    public $name;
    public $website;
    public $photos;

    public function __construct($data){
        $this->address_components = $data->address_components;
        foreach($data->address_components as $comp){
            $this->full_address .= $comp->long_name." ";
        }
        $this->location = [
            'lat' => $data->geometry->location->lat,
            'lng' => $data->geometry->location->lng
        ];
        $this->photos = $data->photos ?? [];
        $this->icon = $data->icon;
        $this->id = $data->id;
        $this->phone_number = $data->international_phone_number ?? "Not Set";
        $this->name = $data->name;
        $this->website = $data->website ?? "Not Set";
    }
}