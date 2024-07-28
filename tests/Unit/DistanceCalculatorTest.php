<?php

namespace Tests\Unit;

use App\Services\DistanceCalculator;
use PHPUnit\Framework\TestCase;

class DistanceCalculatorTest extends TestCase
{
    public function test_example(): void
    {
        $distanceCalculator = new DistanceCalculator();
        $calculatedDistance = $distanceCalculator->calculate(
            startLatitude: 41.390318,
            startLongitude: 2.154485,
            endLatitude: 41.390543,
            endLongitude: 2.154683
        );

        $expectedDistance = 30;
        $this->assertEquals($expectedDistance, $calculatedDistance);
    }
}
