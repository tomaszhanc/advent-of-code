import {readByLine} from "../../shared/read.input";

export function part1(input: string): number {
    const [availablePatterns, desiredDesigns] = parsePuzzleInput(input);

    return desiredDesigns
        .filter(design => canBeMatchedRecursive(design, availablePatterns) > 0)
        .length;
}

export function part2(input: string): number {
    const [availablePatterns, desiredDesigns] = parsePuzzleInput(input);

    return desiredDesigns
        .reduce((sum, design) => sum + canBeMatchedRecursive(design, availablePatterns), 0)
}

function parsePuzzleInput(input: string) : [string[], string[]] {
    const lines = readByLine(input);

    return [lines[0].split(', '), lines.slice(2)];
}

function canBeMatchedRecursive(design: string, patterns: string[], memory: Map<string, number> = new Map<string, number>()): number {
    if (design === "") {
        return 1;
    }

    if (memory.has(design)) {
        return memory.get(design)!;
    }

    let combinationCount = 0;

    for (let pattern of patterns) {
        if (design.startsWith(pattern)) {
            combinationCount += canBeMatchedRecursive(design.slice(pattern.length), patterns, memory);
        }
    }

    memory.set(design, combinationCount);
    return combinationCount;
}