<?php

namespace App\DTO;

use App\Domain\Model\Company;

class CompanyDTO
{
    public string $id;
    public string $name;
    public float $debtorLimit;

    /**
     * @param Company $company
     */
    public function __construct(public Company $company)
    {
        $this->id = $company->getId();
        $this->name = $company->getName();
        $this->debtorLimit = $company->getDebtorLimit();
    }
}
