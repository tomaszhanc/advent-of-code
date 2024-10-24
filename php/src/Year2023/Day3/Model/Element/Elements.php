<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model\Element;

final readonly class Elements
{
    /** @var NumberElement|SymbolElement[] */
    private array $elements;

    public function __construct(NumberElement|SymbolElement ...$elements)
    {
        $this->elements = $elements;
    }

    /** @return NumberElement[] */
    public function numberElements(): array
    {
        return array_filter(
            $this->elements,
            fn ($element) => $element instanceof NumberElement
        );
    }

    /** @return SymbolElement[] */
    public function symbolElements(): array
    {
        return array_filter(
            $this->elements,
            fn ($element) => $element instanceof SymbolElement
        );
    }
}
