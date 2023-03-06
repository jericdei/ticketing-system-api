<?php

namespace App\Traits;

trait Searchable {
    public function getSearchables(): array
    {
        return $this->searchables;
    }
}
