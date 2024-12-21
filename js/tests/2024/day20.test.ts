import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day20/day20";

const example = `
###############
#...#...#.....#
#.#.#.#.#.###.#
#S#...#.#.#...#
#######.#.#.###
#######.#.#...#
#######.#.###.#
###..E#...#...#
###.#######.###
#...###...#...#
#.#####.#.###.#
#.#...#.#.#...#
#.#.#.#.#.#.###
#...#...#...###
###############
`;

const input = readPuzzleInput('2024/day20.txt');

describe('AoC 2024, Day X, Part 1', () => {
    it('checks the example', () => {
        expect(part1(1, example)).toBe(44)
    })

    it('check the input', () => {
        expect(part1(100, input)).toBe(1490)
    })
});

describe('AoC 2024, Day X, Part 2', () => {
    it('checks the example', () => {
        expect(part2(example)).toBe(-1)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(-1)
    })
});