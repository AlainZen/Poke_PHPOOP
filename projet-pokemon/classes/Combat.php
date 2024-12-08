<?php

class Combat {
    private Pokemon $pokemon1;
    private Pokemon $pokemon2;

    public function __construct(Pokemon $pokemon1, Pokemon $pokemon2) {
        $this->pokemon1 = $pokemon1;
        $this->pokemon2 = $pokemon2;
    }

    public function demarrerCombat(): array {
        $logs = [];
        $logs[] = "Le combat commence entre {$this->pokemon1->getName()} (Type: {$this->pokemon1->getType()}) et {$this->pokemon2->getName()} (Type: {$this->pokemon2->getType()}) !";

        while ($this->pokemon1->getHp() > 0 && $this->pokemon2->getHp() > 0) {
            // Pokémon 1 attaque Pokémon 2
            $damage1 = $this->pokemon1->attack($this->pokemon2);
            $logs[] = "{$this->pokemon1->getName()} attaque {$this->pokemon2->getName()} et inflige {$damage1} dégâts.";
            if ($this->pokemon2->getHp() <= 0) {
                $logs[] = "{$this->pokemon2->getName()} est K.O. {$this->pokemon1->getName()} remporte le combat !";
                break;
            }

            // Pokémon 2 attaque Pokémon 1
            $damage2 = $this->pokemon2->attack($this->pokemon1);
            $logs[] = "{$this->pokemon2->getName()} riposte et inflige {$damage2} dégâts à {$this->pokemon1->getName()}.";
            if ($this->pokemon1->getHp() <= 0) {
                $logs[] = "{$this->pokemon1->getName()} est K.O. {$this->pokemon2->getName()} remporte le combat !";
                break;
            }
        }

        return $logs;
    }
}
