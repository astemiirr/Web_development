<?php

namespace Zoo\Interfaces;

interface AnimalInterface
{
    public function makeSound(): string;
    public function eat(string $food): string;
    public function getInfo(): array;
}