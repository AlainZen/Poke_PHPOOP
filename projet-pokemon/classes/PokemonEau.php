<?php

require_once 'Pokemon.php';

class PokemonEau extends Pokemon {
    public function __construct(string $name) {
        parent::__construct($name, 'water', 110, 25);
    }

    public function calculateDamage(Pokemon $opponent): int {
        $baseDamage = $this->attack;
        if ($opponent->getType() === 'fire') {
            $baseDamage += 20; 
        } elseif ($opponent->getType() === 'grass') {
            $baseDamage -= 10; 
        }
        return max(10, $baseDamage);
    }
}
