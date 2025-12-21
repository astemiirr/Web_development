<?php

namespace Zoo\Models;

class Eagle extends Animal
{
    private float $wingspan;
    
    public function __construct(string $name, int $age, float $wingspan)
    {
        parent::__construct($name, $age);
        $this->wingspan = $wingspan;
    }
    
    public function makeSound(): string
    {
        return 'Kriiiii-kriiiii!';
    }

    public function getDailyFood(): float
    {
        return 0.5; // кг пищи в день
    }
    
    public function fly(): string
    {
        return $this->name . ' flies with wingspan ' . $this->wingspan . 'm';
    }
    
    public function getInfo(): array
    {
        $info = parent::getInfo();
        $info['type'] = 'Eagle';
        $info['wingspan'] = $this->wingspan;
        return $info;
    }
}