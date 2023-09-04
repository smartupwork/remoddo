<?php


namespace App\Utils\Filters\TagFilter;

use App\Utils\Filters\FilterContract;

class Search implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query->where('is_show', true)->where('title', 'like', "%$value%");
    }
}
