<?php

require_once 'Pokemon.php';

class PokemonPlante extends Pokemon {
    public function __construct(string $name) {
        parent::__construct($name, 'grass', 120, 20);
    }

    public function calculateDamage(Pokemon $opponent): int {
        $baseDamage = $this->attack;
        if ($opponent->getType() === 'water') {
            $baseDamage += 20; 
        } elseif ($opponent->getType() === 'fire') {
            $baseDamage -= 10; 
        }
        return max(10, $baseDamage);
    }
}
