<?php

declare(strict_types=1);

namespace AoC\Year2023\Day3;

use AoC\Common\LineParser;
use AoC\Common\Cell;
use AoC\Common\NumberedLineParser;
use AoC\Year2023\Day3\EngineSchematic\Element;
use AoC\Year2023\Day3\EngineSchematic\Elements;
use AoC\Year2023\Day3\EngineElementsParser\EngineElementsLexer;
use AoC\Year2023\Day3\EngineElementsParser\Type;

/**
 * @template-implements LineParser<Elements>
 */
final readonly class EngineElementsParser implements NumberedLineParser
{
    private EngineElementsLexer $lexer;

    public function __construct()
    {
        $this->lexer = new EngineElementsLexer();
    }

    public function parse(int $lineNumber, string $line): Elements
    {
        $elements = [];
        $this->lexer->setInput($line);
        $this->lexer->moveNext();

        while ($this->lexer->lookahead !== null) {
            $location = new Cell(column: $this->lexer->lookahead->position, row: $lineNumber);

            if ($this->lexer->isNextToken(Type::T_SYMBOL)) {
                $elements[] = Element::symbol($location, $this->lexer->lookahead->value);
            }

            if ($this->lexer->isNextToken(Type::T_NUMBER)) {
                $elements[] = Element::number($location, (int) $this->lexer->lookahead->value);
            }

            $this->lexer->moveNext();
        }

        return Elements::create(...$elements);
    }
}
