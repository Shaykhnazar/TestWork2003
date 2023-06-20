<?php

namespace App\Models\Traits;

trait HasIncludeWithTrait
{
    public function scopeIncludeWith($query, $includeWith)
    {
        if ($includeWith) {
            $query->with($includeWith);
        }

        return $query;
    }
}
