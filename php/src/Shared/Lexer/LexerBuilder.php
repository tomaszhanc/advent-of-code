<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

use Advent\Shared\Lexer\Attributes\Regex;
use Advent\Shared\Lexer\Doctrine\DoctrineLexer;

final class LexerBuilder
{
    /** @var array<class-string> */
    private array $definitions = [];

    /**
     * @param class-string<\UnitEnum> $enumName
     */
    public function readTokenTypesFrom(string $enumName): self
    {
        try {
            new \ReflectionEnum($enumName);
        } catch (\ReflectionException) {
            throw new \Exception('Token type must be an enum');
        }

        $this->definitions[] = $enumName;

        return $this;
    }

    public function build(): Lexer
    {
        $patterns = [];

        foreach ($this->definitions as $enumName) {
            foreach ($enumName::cases() as $case) {
                $caseReflection = new \ReflectionEnumUnitCase($enumName, $case->name);

                foreach ($caseReflection->getAttributes(Regex::class) as $regex) {
                    if ($regex !== null) {
                        $patterns[] = [$regex->newInstance(), $case];
                    }
                }
            }
        }

        return new Lexer(new DoctrineLexer($patterns));
    }
}
