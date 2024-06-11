<?php

namespace App\Factory;

use App\Domain\Model\Company;

class CompanyFactory
{
    /**
     * @param string $id
     * @param string $name
     * @param float $debtorLimit
     * @return Company
     */
    public static function create(string $id, string $name, float $debtorLimit): Company
    {
        return new Company($id, $name, $debtorLimit);
    }
}
