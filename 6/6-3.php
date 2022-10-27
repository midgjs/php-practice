<?php

class Entree {
    public $name;
    public $ingredients = array();

    public function __construct($name, $ingredients) {
        $this->name=$name;
        $this->ingredients = $ingredients;
    }

    public function hasIngredient($ingredient) {
        return in_array($ingredient, $this->ingredients);
    }
    
}


class PricedEntree extends Entree {
    public function __construct($name, $ingredients){
        parent::__construct($name, $ingredients);
        foreach ($this->ingredients as $ingredient){
            if(! $ingredient instanceof Ingredient) {
                throw new Exception('$ingredients의 원소는
                Ingredient 객체여야 합니다.');
            }
        }
    }
    public function getCost() {
        $cost=0;
        foreach ($this->ingredients as $ingredient){
            $cost += $ingredient->getCost();
        }

        return $cost;
    }
}































?>