<?php

namespace App\Application\Service;

use App\Domain\Repository\CompanyRepositoryInterface;
use App\Factory\CompanyFactory;
use App\DTO\CompanyDTO;

class CompanyApplicationService
{
    /**
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(private CompanyRepositoryInterface $companyRepository)
    {
    }

    /**
     * @param string $name
     * @param float $debtorLimit
     * @return CompanyDTO
     */
    public function createCompany(string $name, float $debtorLimit): CompanyDTO
    {
        $id = uniqid();
        $company = CompanyFactory::create($id, $name, $debtorLimit);
        $this->companyRepository->add($company);

        return new CompanyDTO($company);
    }
}
