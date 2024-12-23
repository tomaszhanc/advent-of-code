import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {mix, part1, part2, prune} from "../../src/2024/day22/day22";

const example = `

`;
const input = readPuzzleInput('2024/day22.txt');

describe('AoC 2024, Day 22, Part 1', () => {
    it('checks the example', () => {
        expect(part1('123')).toBe(15887950)
    })

    it('check the input', () => {
        expect(part1(input)).toBe(-1)
    })
});

describe('AoC 2024, Day 22, Part 2', () => {
    it('checks the example', () => {
        expect(part2(example)).toBe(-1)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(-1)
    })
});