<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer\Doctrine;

use Advent\Shared\Lexer\Attributes\Regex;

final class DoctrineLexerBuilder
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

    public function build(): DoctrineLexer
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

        return new DoctrineLexer($patterns);
    }
}
