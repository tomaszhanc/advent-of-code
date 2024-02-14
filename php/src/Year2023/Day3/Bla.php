<?php

declare(strict_types=1);

namespace AoC\Year2023\Day3;

use AoC\Year2023\Day3\EngineSchematic\Elements;
use AoC\Year2023\Day3\EngineSchematic\PartNumber;

final readonly class Bla
{
    /**
     * @param Elements[] $engingeSchematicLines
     */
    public function __construct(private array $engingeSchematicLines)
    {
    }

    public static function create(Elements ...$elements) : self
    {
        return new self($elements);
    }


    /**
     * @return PartNumber[]
     */
    public function foo(): array
    {
        $partNumbers = [];

        foreach ($this->engingeSchematicLines as $elements) {
            foreach ($elements->allNumberElements() as $numberElement) {
                if ($elements->isSymbolElementAdjacentTo($numberElement)) {
                    $partNumbers[] = $numberElement->toPartNumber();

                    // FIXME: chyba niektore elementy to jest bardziej Range niz Cell, ale nie pamietam o co dokaldne chodzilo, tutaj kontynuuj
                }

                // fixme tutaj teraz jeszcze sprawdzić czy isSymbolAdjacentTo(elemnt) ale do $elements z kolejnej linii
            }
        }

        return $partNumbers;
    }
}