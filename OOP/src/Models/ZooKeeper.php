<?php

namespace Zoo\Models;

use Zoo\Interfaces\AnimalInterface;

class ZooKeeper
{
    private string $name;
    private array $assignedAnimals = [];
    private int $experience;
    
    public function __construct(string $name, int $experience = 0)
    {
        $this->name = $name;
        $this->experience = $experience;
    }
    
    public function assignAnimal(AnimalInterface $animal): void
    {
        $this->assignedAnimals[] = $animal;
        echo "{$this->name} is now taking care of {$animal}\n";
    }
    
    public function feedAnimals(): array
    {
        $result = [];
        foreach ($this->assignedAnimals as $animal) {
            $food = "meat"; // Кормим всех мясом
            $result[] = $animal->eat($food);
        }
        $this->experience += count($this->assignedAnimals);
        return $result;
    }
    
    public function __toString(): string
    {
        return "ZooKeeper {$this->name} with {$this->experience} experience points, caring for " . 
               count($this->assignedAnimals) . " animals";
    }
    
    public function getInfo(): array
    {
        return [
            'name' => $this->name,
            'experience' => $this->experience,
            'animals_count' => count($this->assignedAnimals),
            'animal_names' => array_map(fn($a) => $a->getInfo()['name'], $this->assignedAnimals)
        ];
    }
}