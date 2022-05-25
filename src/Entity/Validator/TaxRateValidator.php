<?php

namespace Recruitment\Entity\Validator;

class TaxRateValidator
{
    private const VALID_TAX_RATES = [0, 5, 8, 23];

    public static function validateTaxRate(int $taxRate): bool
    {
        return in_array($taxRate, self::VALID_TAX_RATES);
    }
}
