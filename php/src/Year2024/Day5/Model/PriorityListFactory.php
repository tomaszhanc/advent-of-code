<?php

declare(strict_types=1);

namespace Advent\Year2024\Day5\Model;

use Advent\Shared\Graph\Edge;
use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\Node\IntegerNode;
use Advent\Shared\Graph\Sort\TopologicalSort;
use Advent\Shared\Other\NumberList;

final readonly class PriorityListFactory
{
    /** @var Rule[] */
    private array $rules;

    public function __construct(Rule ...$rules)
    {
        $this->rules = $rules;
    }

    public function generateFor(NumberList $list): PriorityList
    {
        $edges = [];
        foreach ($this->findRulesFor($list) as $rule) {
            $edges[] = Edge::directed(new IntegerNode($rule->left), new IntegerNode($rule->right), 1);
        }

        $sortedNodes = new TopologicalSort()->sortNodes(new Graph(...$edges));

        return new PriorityList(
            new NumberList(...array_map(
                fn (IntegerNode $node): int => $node->id,
                $sortedNodes
            ))
        );
    }

    /** @return Rule[] */
    private function findRulesFor(NumberList $list): array
    {
        $numbers = $list->toArray();

        return array_filter(
            $this->rules,
            fn (Rule $rule): bool => in_array($rule->left, $numbers) && in_array($rule->right, $numbers)
        );
    }
}
