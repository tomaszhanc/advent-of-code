<?php

declare(strict_types=1);

namespace Advent\Year2024\Day5\Parser;

use Advent\Shared\Input\Input;
use Advent\Shared\Other\NumberList;
use Advent\Year2024\Day5\Model\PageUpdates;
use Advent\Year2024\Day5\Model\PriorityListFactory;
use Advent\Year2024\Day5\Model\Rule;

final readonly class PageOrderingRulesParser
{
    /** @return array{PriorityListFactory, PageUpdates} */
    public function parse(Input $input): array
    {
        [$rulesInput, $updatesInput] = explode("\n\n", $input->content());

        $rules = [];
        foreach (explode("\n", $rulesInput) as $rule) {
            [$left, $right] = explode("|", $rule);
            $rules[] = new Rule((int) $left, (int) $right);
        }

        $updates = [];
        foreach (explode("\n", $updatesInput) as $update) {
            $updates[] = new NumberList(
                ...array_map('intval', explode(",", $update))
            );
        }

        return [
            new PriorityListFactory(...$rules),
            new PageUpdates(...$updates),
        ];
    }
}
