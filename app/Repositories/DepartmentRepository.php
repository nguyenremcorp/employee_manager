<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Support\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * implements function deparmentList of DepartmentRepositoryInterface
     *
     * @param array $options
     * @return Collection
     */
    public function deparmentList($options = []): Collection
    {
        $limit  = $options['limit']  ?? null;
        $offset = $options['offset'] ?? null;

        $query = Department::select('id', 'name')
            ->when($limit, function ($q) use ($limit) {
                return $q->limit($limit);
            })
            ->when($offset, function ($q) use ($offset) {
                return $q->offset($offset);
            });

        return $query->get();
    }
}
