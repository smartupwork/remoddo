<?php


namespace App\Utils\Filters\OrderFilter;

use App\Utils\Filters\FilterContract;

class Status implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query->whereIn('status', $value);
    }
}
