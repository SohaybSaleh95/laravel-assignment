<?php


namespace App;

class APIResponse{

    public $data = [];
    public $message = "The request was completed successfully!";
    public $code = 200;

    public function getResult(){
        return response()->json($this,$this->code);
    }

    public function setMessage($msg,$code = 200){
        $this->message = $msg;
        $this->code = $code;
    }

}