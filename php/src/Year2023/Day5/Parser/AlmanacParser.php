<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Parser;

use Advent\Shared\Lexer\LexerInterface;
use Advent\Shared\Lexer\RuntimeException;
use Advent\Shared\Lexer\Tokens;
use Advent\Year2023\Day5\Model\Almanac;
use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\MapRule;
use Advent\Year2023\Day5\Model\Almanac\Seeds;

final readonly class AlmanacParser
{
    public function __construct(
        private LexerInterface $lexer
    ) {
    }

    public function parse(string $line): Almanac
    {
        $tokens = $this->lexer->tokenize($line);

        $tokens->skipUntil(AlmanacType::SEEDS);
        $tokens->next();

        $seeds = new Seeds(...$this->parseNumbers($tokens));
        $seedToSoilMap = $this->parseMap('seed-to-soil map', $tokens);
        $soilToFertilizerMap = $this->parseMap('soil-to-fertilizer map', $tokens);
        $fertilizerToWater = $this->parseMap('fertilizer-to-water map', $tokens);
        $waterToLight = $this->parseMap('water-to-light map', $tokens);
        $lightToTemperature = $this->parseMap('light-to-temperature map', $tokens);
        $temperatureToHumidity = $this->parseMap('temperature-to-humidity map', $tokens);
        $humidityToLocation = $this->parseMap('humidity-to-location map', $tokens);

        return new Almanac(
            $seeds,
            $seedToSoilMap,
            $soilToFertilizerMap,
            $fertilizerToWater,
            $waterToLight,
            $lightToTemperature,
            $temperatureToHumidity,
            $humidityToLocation
        );
    }

    private function parseMap(string $mapName, Tokens $tokens): Map
    {
        $tokens->skipUntil(AlmanacType::MAP);

        if ($tokens->current()->value !== $mapName) {
            throw new RuntimeException(sprintf('Unexpected map. Expected "%s", given "%s"', $mapName, $tokens->current()->value));
        }

        $ranges = [];
        $tokens->next();
        $tokens->next();

        while ($tokens->hasMore() && $tokens->current()->isA(AlmanacType::NUMBER)) {
            $ranges[] = MapRule::create(...$this->parseNumbers($tokens));
            $tokens->next();
        }

        return new Map(...$ranges);
    }

    /** @return int[] */
    private function parseNumbers(Tokens $tokens): array
    {
        $numbers = [];

        while ($tokens->hasMore() && $tokens->current()->isA(AlmanacType::NUMBER)) {
            $numbers[] = (int) $tokens->current()->value;
            $tokens->next();
        }

        return $numbers;
    }
}
