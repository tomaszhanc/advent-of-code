import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day22/day22";

const input = readPuzzleInput('2024/day22.txt');
const examplePart1 = `
1
10
100
2024
`;
const examplePart2 = `
1
2
3
2024
`;

describe('AoC 2024, Day 22, Part 1', () => {
    it('checks the example', () => {
        expect(part1(examplePart1)).toBe(37327623)
    })

    it('check the input', () => {
        expect(part1(input)).toBe(18941802053)
    })
});

describe('AoC 2024, Day 22, Part 2', () => {
    it('checks the example', () => {
        expect(part2(examplePart2)).toBe(23)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(2218)
    })
});