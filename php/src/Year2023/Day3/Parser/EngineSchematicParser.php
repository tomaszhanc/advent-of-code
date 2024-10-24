<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Parser;

use Advent\Year2023\Day3\Model\Element\Elements;
use Advent\Year2023\Day3\Model\Element\NumberElement;
use Advent\Year2023\Day3\Model\Element\SymbolElement;

final readonly class EngineSchematicParser
{
    public function __construct(
        private EngineSchematicLexer $lexer
    ) {
    }

    public function parse(int $lineNumber, ?string $line): Elements
    {
        if ($line === null) {
            return new Elements();
        }

        $elements = [];

        foreach ($this->lexer->tokenize($line) as $token) {
            if ($token->isA(EngineSchematicType::NUMBER)) {
                $elements[] = new NumberElement($lineNumber, $token->position, (int) $token->value);
            }

            if ($token->isA(EngineSchematicType::SYMBOL)) {
                $elements[] = new SymbolElement($lineNumber, $token->position, $token->value);
            }
        }

        return new Elements(...$elements);
    }
}
