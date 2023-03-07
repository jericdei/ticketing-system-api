<?php

namespace App\Traits;

trait Queryable {
    public function getAllowedFields(): array
    {
        return $this->allowedFields;
    }

    public function getAllowedFilters(): array
    {
        return $this->allowedFilters;
    }

    public function getAllowedSorts(): array
    {
        return $this->allowedSorts;
    }

    public function getAllowedIncludes(): array
    {
        return $this->allowedIncludes;
    }

    public function getAllowedSearches(): array
    {
        return $this->allowedSearches;
    }
}
