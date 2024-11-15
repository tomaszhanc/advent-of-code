<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Assertion\Lexer\SimplifiedToken;
use Advent\Tests\Shared\Assertion\Lexer\TokenAssertion;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2023\Day8\Parser\InstructionsType;
use Advent\Year2023\Day8\Parser\MapType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LexerTokensTypeTest extends TestCase
{
    use TokenAssertion;

    #[Test]
    public function it_tokenizes_instructions(): void
    {
        $lexer = new Lexer(InstructionsType::class);
        $input = 'LRLLRRRLRRL';

        $this->assertTokensAreEqual(
            [
                new SimplifiedToken('L', InstructionsType::MOVE),
                new SimplifiedToken('R', InstructionsType::MOVE),
                new SimplifiedToken('L', InstructionsType::MOVE),
                new SimplifiedToken('L', InstructionsType::MOVE),
                new SimplifiedToken('R', InstructionsType::MOVE),
                new SimplifiedToken('R', InstructionsType::MOVE),
                new SimplifiedToken('R', InstructionsType::MOVE),
                new SimplifiedToken('L', InstructionsType::MOVE),
                new SimplifiedToken('R', InstructionsType::MOVE),
                new SimplifiedToken('R', InstructionsType::MOVE),
                new SimplifiedToken('L', InstructionsType::MOVE),
            ],
            iterator_to_array($lexer->tokenize($input)),
        );
    }

    #[Test]
    public function it_tokenizes_nodes(): void
    {
        $lexer = new Lexer(MapType::class);
        $input = new InMemoryInput(
            'AAA = (AAR, BBL)',
            'BBL = (DDD, EEE)'
        );

        $this->assertTokensAreEqual(
            [
                new SimplifiedToken('AAA', MapType::NODE),
                new SimplifiedToken('=', MapType::EQUALS_SIGN),
                new SimplifiedToken('AAR', MapType::NODE),
                new SimplifiedToken('BBL', MapType::NODE),
                SimplifiedToken::endOfLine(MapType::NEW_LINE),
                new SimplifiedToken('BBL', MapType::NODE),
                new SimplifiedToken('=', MapType::EQUALS_SIGN),
                new SimplifiedToken('DDD', MapType::NODE),
                new SimplifiedToken('EEE', MapType::NODE),
            ],
            iterator_to_array($lexer->tokenize($input->content())),
        );
    }
}
