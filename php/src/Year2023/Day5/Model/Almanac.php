<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model;

use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\Seeds;

final readonly class Almanac
{
    public function __construct(
        private Seeds $seeds,
        private Map   $seedToSoil,
        private Map   $soilToFertilizer,
        private Map   $fertilizerToWater,
        private Map   $waterToLight,
        private Map   $lightToTemperature,
        private Map   $temperatureToHumidity,
        private Map   $humidityToLocation
    ) {
    }

    public function lowestLocationNumber(): int
    {
        $minLocation = PHP_INT_MAX;

        foreach ($this->seeds->asSeeds() as $seed) {
            $soil = $this->seedToSoil->destinationNumber($seed);
            $fertilizer = $this->soilToFertilizer->destinationNumber($soil);
            $water = $this->fertilizerToWater->destinationNumber($fertilizer);
            $light = $this->waterToLight->destinationNumber($water);
            $temperature = $this->lightToTemperature->destinationNumber($light);
            $humidity = $this->temperatureToHumidity->destinationNumber($temperature);
            $location = $this->humidityToLocation->destinationNumber($humidity);

            $minLocation = min($minLocation, $location);
        }

        return $minLocation;
    }

    public function lowestLocationNumberWithSeedRanges(): int
    {
        $minLocation = PHP_INT_MAX;

        foreach ($this->seeds->asRanges() as $seedRange) {
            foreach ($seedRange->seeds() as $seed) {
                //$minLocation = min($minLocation, $this->locationFor($seed));
            }
        }

        return $minLocation;
    }
}
