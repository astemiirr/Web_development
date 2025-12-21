<?php

namespace Zoo\Traits;

trait JsonableTrait
{
    public function toJson(): string
    {
        return json_encode($this->getInfo(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}