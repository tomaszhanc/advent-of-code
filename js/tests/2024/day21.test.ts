import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day21/day21.js";

const example = `
029A
980A
179A
456A
379A
`;
const input = readPuzzleInput('2024/day21.txt');

describe('AoC 2024, Day 21, Part 1', () => {
    it('checks the example', () => {
        expect(part1(example)).toBe(126384)
    })

    it('check the input', () => {
        expect(part1(input)).toBe(211930)
    })
});

describe('AoC 2024, Day 21, Part 2', () => {
    it('checks the example', () => {
        expect(part2(example)).toBe(-1)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(-1)
    })
});