import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day25/day25";

const example = `
#####
.####
.####
.####
.#.#.
.#...
.....

#####
##.##
.#.##
...##
...#.
...#.
.....

.....
#....
#....
#...#
#.#.#
#.###
#####

.....
.....
#.#..
###..
###.#
###.#
#####

.....
.....
.....
#....
#.#..
#.#.#
#####
`;
const input = readPuzzleInput('2024/day25.txt');

describe('AoC 2024, Day 25, Part 1', () => {
    it('checks the example', () => {
        expect(part1(example)).toBe(3)
    })

    it('check the input', () => {
        expect(part1(input)).toBe(3090)
    })
});

describe('AoC 2024, Day 25, Part 2', () => {
    it('checks the example', () => {
        expect(part2(example)).toBe(-1)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(-1)
    })
});