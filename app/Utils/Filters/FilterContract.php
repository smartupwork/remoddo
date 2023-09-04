<?php


namespace App\Utils\Filters;

interface FilterContract
{
    public function handle($value): void;
}
