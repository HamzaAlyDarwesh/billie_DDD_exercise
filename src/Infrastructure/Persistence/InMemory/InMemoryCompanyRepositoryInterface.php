<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Model\Company;
use App\Domain\Repository\CompanyRepositoryInterface;

class InMemoryCompanyRepositoryInterface implements CompanyRepositoryInterface
{
    private array $companies = [];

    public function add(Company $company): void
    {
        $this->companies[$company->getId()] = $company;
    }

    public function findById(string $id): ?Company
    {
        return $this->companies[$id] ?? null;
    }
}
