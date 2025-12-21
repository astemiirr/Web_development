<?php

namespace Zoo\Traits;

trait LoggerTrait
{
    protected function log(string $message): void
    {
        echo '[' . date('H:i:s') . '] ' . $message . "\n";
    }
    
    protected function validateAge(int $age): bool
    {
        return $age >= 0 && $age <= 100;
    }
}