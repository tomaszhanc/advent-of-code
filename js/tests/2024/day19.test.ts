import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day19/day19";

const example = `
r, wr, b, g, bwu, rb, gb, br

brwrr
bggr
gbbr
rrbgbr
ubwu
bwurrg
brgr
bbrgwb
`;

const input = readPuzzleInput('2024/day19.txt');

describe('AoC 2024, Day 19, Part 1', () => {
    it('checks the example', () => {
        expect(part1(example)).toBe(6)
    })

    it('check the input', () => {
        expect(part1(input)).toBe(311)
    })
});

describe('AoC 2024, Day 19, Part 2', () => {
    it('checks the example', () => {
        expect(part2(example)).toBe(16)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(616234236468263)
    })
});