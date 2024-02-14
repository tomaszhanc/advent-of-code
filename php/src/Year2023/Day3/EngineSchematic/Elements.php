<?php

declare(strict_types=1);

namespace AoC\Year2023\Day3\EngineSchematic;

final readonly class Elements
{
    /**
     * @param Element[] $elements
     */
    public function __construct(private array $elements)
    {
    }

    public static function create(Element ...$elements) : self
    {
        return new self($elements);
    }

    public function isSymbolElementAdjacentTo(Element $element) : bool
    {
        foreach ($this->allSymbolElements() as $symbolElement) {
            if ($symbolElement->cell->isAdjacentTo($element->cell)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Element[]
     */
    public function allNumberElements() :array
    {
        return \array_filter($this->elements, fn (Element $element) : bool => $element->isNumber());
    }

    /**
     * @return Element[]
     */
    public function allSymbolElements() :array
    {
        return \array_filter($this->elements, fn (Element $element) : bool => !$element->isNumber());
    }
}
