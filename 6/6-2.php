<?php

class Ingredient{
    protected $name;
    protected $cost;

    public function __construct($name, $cost){
        $this->name = $name;
        $this->cost = $cost;
    }

    public function getName(){
        return $this->name;
    }

    public function getCost(){
        return $this->cost;
    }

    //cost 수정 메서드
    public function setCost($cost){
        $this->cost = $cost;
    }


}

















?>