<?php

namespace Zoo\Models;

final class Lion extends Animal
{
    private float $maneSize;
    
    public function __construct(string $name, int $age, float $maneSize)
    {
        parent::__construct($name, $age);
        $this->maneSize = $maneSize;
    }
    
    public function makeSound(): string
    {
        return 'RRRRRRRUU!';
    }

    public function getDailyFood(): float
    {
        return 7.0; // кг мяса в день
    }
    
    public function hunt(): string
    {
        return $this->name . ' is hunting';
    }
    
    final public function getRoarPower(): int
    {
        return (int)($this->age * $this->maneSize);
    }
    
    public function getInfo(): array
    {
        $info = parent::getInfo();
        $info['type'] = 'Lion';
        $info['maneSize'] = $this->maneSize;
        return $info;
    }
}