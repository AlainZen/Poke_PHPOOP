<?php

require_once 'Pokemon.php';

class PokemonFeu extends Pokemon {
    public function __construct(string $name) {
        parent::__construct($name, 'fire', 100, 30);
    }

    public function calculateDamage(Pokemon $opponent): int {
        $baseDamage = $this->attack;
        if ($opponent->getType() === 'grass') {
            $baseDamage += 20; 
        } elseif ($opponent->getType() === 'water') {
            $baseDamage -= 10; 
        }
        return max(10, $baseDamage); 
    }
}
