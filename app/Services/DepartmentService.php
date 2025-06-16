<?php

namespace App\Services;

use App\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Support\Collection;

class DepartmentService
{
    protected DepartmentRepositoryInterface $deparmentRepository;

    /**
     * __construct function
     *
     * @param DepartmentRepositoryInterface $deparmentRepository
     */
    public function __construct(DepartmentRepositoryInterface $deparment)
    {
        $this->deparmentRepository = $deparment;
    }

    /**
     * Get deparment list 
     *
     * @param array $options
     * @return Collection
     */
    public function deparmentListService(array $options = []): Collection
    {
        return $this->deparmentRepository->deparmentList($options);
    }
}
