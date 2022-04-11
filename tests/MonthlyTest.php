<?php

namespace Monthly\Tests;

use Monthly\Monthly;
use PHPUnit\Framework\TestCase;

class MonthlyTest extends TestCase
{
    /**
     * @param array{totalCost: float, deposit: float, totalMonthlyPayments: int, annualRate: float} $input
     * @param array{loanAmount: float, monthlyPayment: float, totalPayable: float, totalInterest: float} $expectedResult
     *
     * @dataProvider provideTestCalculate
     */
    public function testCalculate(array $input, array $expectedResult): void {
        $result = Monthly::calculate(
            $input['totalCost'],
            $input['deposit'],
            $input['totalMonthlyPayments'],
            $input['annualRate'],
        );
        $this->assertEquals($expectedResult['loanAmount'], $result['loanAmount']);
        $this->assertEquals($expectedResult['monthlyPayment'], $result['monthlyPayment']);
        $this->assertEquals($expectedResult['totalPayable'], $result['totalPayable']);
        $this->assertEquals($expectedResult['totalInterest'], $result['totalInterest']);
    }

    /**
     * @return array[]
     */
    public function provideTestCalculate(): array
    {
        return [
            [
                ['totalCost' => 1100.00, 'deposit' => 100.00, 'totalMonthlyPayments' => 24, 'annualRate' => 10.0],
                ['loanAmount' => 1000.00, 'monthlyPayment' => 46.14, 'totalPayable' => 1107.48, 'totalInterest' => 107.48],
            ],
            [
                ['totalCost' => 3000.00, 'deposit' => 500.00, 'totalMonthlyPayments' => 30, 'annualRate' => 8.8],
                ['loanAmount' => 2500.00, 'monthlyPayment' => 93.14, 'totalPayable' => 2794.19, 'totalInterest' => 294.19],
            ],
            [
                ['totalCost' => 2972.40, 'deposit' => 404.51, 'totalMonthlyPayments' => 11, 'annualRate' => 17.9],
                ['loanAmount' => 2567.89, 'monthlyPayment' => 254.85, 'totalPayable' => 2803.39, 'totalInterest' => 235.50],
            ],
        ];
    }
}
