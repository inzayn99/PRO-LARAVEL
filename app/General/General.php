<?php


namespace App\General;


use Illuminate\Support\Facades\Config;

trait General
{
    public $data= [];
    public function data($key,$value){
        return $this->data[$key]=$value;
    }

    public function makeTitle($backPart,$seperator = " : ",$frontPart=null){
        if(!isset($frontpart)){
            $frontPart=ucfirst(Config::get('title.company_name'));
        }
        return $frontPart.$seperator.ucfirst($backPart);
    }
}
