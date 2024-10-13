<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3;

use Advent\Shared\Grid\Cell;
use Advent\Year2023\Day3\EngineElementsParser\EngineElementsLexer;
use Advent\Year2023\Day3\EngineElementsParser\Type;
use Advent\Year2023\Day3\EngineSchematic\Element;
use Advent\Year2023\Day3\EngineSchematic\Elements;

final readonly class EngineElementsParserDeprecated
{
    private EngineElementsLexer $lexer;

    public function __construct()
    {
        $this->lexer = new EngineElementsLexer();
    }

    public function parse(string $line, int $lineNumber): Elements
    {
        $elements = [];
        $this->lexer->setInput($line);
        $this->lexer->moveNext();

        while ($this->lexer->lookahead !== null) {
            $location = new Cell(columnIndex: $this->lexer->lookahead->position, rowIndex: $lineNumber);

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
