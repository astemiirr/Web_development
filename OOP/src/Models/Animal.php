<?php

namespace Zoo\Models;

use Zoo\Interfaces\AnimalInterface;
use Zoo\Traits\LoggerTrait;
use Zoo\Traits\JsonableTrait;

abstract class Animal implements AnimalInterface
{
    use LoggerTrait, JsonableTrait;
    
    protected string $name;
    protected int $age;
    protected string $id;
    
    private static int $animalCount = 0;
    private static int $nextId = 1;
    
    public function __construct(string $name, int $age)
    {
        if (!$this->validateAge($age)) {
            throw new \InvalidArgumentException('Incorrect age');
        }
        
        $this->name = $name;
        $this->age = $age;
        $this->id = 'animal_' . self::$nextId++;
        self::$animalCount++;
        
        $this->log("Constructed animal: $name (ID: {$this->id})");
    }
    
    public function __destruct()
    {
        self::$animalCount--;
        $this->log("Destructed animal: {$this->name} (ID: {$this->id})");
    }
    
    public function __toString(): string
    {
        return $this->name . ' (' . $this->age . ' y.o.)';
    }
    
    public function __debugInfo(): array
    {
        return ['name' => $this->name, 'age' => $this->age, 'id' => $this->id];
    }
    
    public function __clone()
    {
        $this->id = 'clone_' . self::$nextId++;
        $this->name = 'Clone ' . $this->name;
        $this->log('Created clone (ID: ' . $this->id . ')');
    }
    
    public function __sleep(): array
    {
        return ['name', 'age', 'id'];
    }
    
    public function __wakeup(): void
    {
        $this->log('Object restored from serialization (ID: ' . $this->id . ')');
    }
    
    abstract public function makeSound(): string;
    abstract public function getDailyFood(): float;
    
    public function eat(string $food): string
    {
        return $this->name . ' is eating ' . $food;
    }
    
    public function getInfo(): array
    {
        return ['name' => $this->name, 'age' => $this->age, 'id' => $this->id];
    }
    
    final public function getId(): string
    {
        return $this->id;
    }
    
    public static function getTotalAnimals(): int
    {
        return self::$animalCount;
    }
}