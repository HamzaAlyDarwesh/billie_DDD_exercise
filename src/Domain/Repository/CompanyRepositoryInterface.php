<?php

namespace App\Domain\Repository;

use App\Domain\Model\Company;

interface CompanyRepositoryInterface
{
    /**
     * @param Company $company
     * @return void
     */
    public function add(Company $company): void;

    /**
     * @param string $id
     * @return Company|null
     */
    public function findById(string $id): ?Company;
}
