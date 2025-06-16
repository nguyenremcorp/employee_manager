<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface DepartmentRepositoryInterface
{
    /**
     * Get deparment list
     * 
     * @param array $options
     * @return Collection
     */
    public function deparmentList($options = []): Collection;
}
