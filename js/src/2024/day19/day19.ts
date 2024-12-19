import {readByLine} from "../../shared/read.input";

export function part1(input: string): number {
    const [availablePatterns, desiredDesigns] = parsePuzzleInput(input);

    return desiredDesigns
        .filter(design => canBeMatched(design, availablePatterns))
        .length;
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) : [string[], string[]] {
    const lines = readByLine(input);

    return [lines[0].split(', '), lines.slice(2)];
}

function canBeMatched(design: string, patterns: string[], memory = new Map<string, boolean>): boolean {
    if (design.length === 0) {
        return true;
    }

    if (memory.has(design)) {
        return memory.get(design)!;
    }

    for (const pattern of patterns) {
        if (design.startsWith(pattern)) {
            if (canBeMatched(design.slice(pattern.length), patterns, memory)) {
                memory.set(design, true);
                return true;
            }
        }
    }

    memory.set(design, false);
    return false;
}