<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

use Advent\Shared\Lexer\Doctrine\DoctrineLexerBuilder;

/**
 * @template T of \UnitEnum
 */
final readonly class Lexer implements LexerInterface
{
    /** @var class-string<T>[] */
    private array $tokenTypeClassNames;

    /**
     * @param class-string<T>[] $tokenTypeClassNames
     */
    public function __construct(string ...$tokenTypeClassNames)
    {
        $this->tokenTypeClassNames = $tokenTypeClassNames;
    }

    /**
     * @return Tokens<Token<T>>
     * @throws \Exception
     */
    public function tokenize(string $input): Tokens
    {
        $builder = (new DoctrineLexerBuilder());

        foreach ($this->tokenTypeClassNames as $tokenTypeClassName) {
            $builder->readTokenTypesFrom($tokenTypeClassName);
        }

        $lexer = $builder->build();
        $lexer->setInput($input);
        $lexer->moveNext();

        return new Tokens($lexer);
    }
}
