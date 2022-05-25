<?php

namespace Recruitment\Tests\Entity\Validator;

use PHPUnit\Framework\TestCase;
use Recruitment\Entity\Validator\TaxRateValidator;

class TaxRateValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function itAcceptsValidTaxRate(): void
    {
        $this->assertTrue(TaxRateValidator::validateTaxRate(0));
        $this->assertTrue(TaxRateValidator::validateTaxRate(5));
        $this->assertTrue(TaxRateValidator::validateTaxRate(8));
        $this->assertTrue(TaxRateValidator::validateTaxRate(23));
    }

    /**
     * @test
     */
    public function itRejectsInvalidTaxRate(): void
    {
        $this->assertFalse(TaxRateValidator::validateTaxRate(1));
    }
}