<?php

abstract class Pokemon {
    protected string $name;
    protected string $type;
    protected int $hp;
    protected int $attack;

    public function __construct(string $name, string $type, int $hp, int $attack) {
        $this->name = $name;
        $this->type = $type;
        $this->hp = $hp;
        $this->attack = $attack;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function reduceHp(int $damage): void {
        $this->hp = max(0, $this->hp - $damage);
    }

    public function attack(Pokemon $opponent): int {
        $damage = $this->calculateDamage($opponent);
        $opponent->reduceHp($damage);
        return $damage;
    }

    abstract public function calculateDamage(Pokemon $opponent): int;
}
