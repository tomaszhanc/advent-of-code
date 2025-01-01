import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day16/day16";

const example1 = `
###############
#.......#....E#
#.#.###.#.###.#
#.....#.#...#.#
#.###.#####.#.#
#.#.#.......#.#
#.#.#####.###.#
#...........#.#
###.#.#####.#.#
#...#.....#.#.#
#.#.#.###.#.#.#
#.....#...#.#.#
#.###.#.#.#.#.#
#S..#.....#...#
###############
`;

const example2 = `
#################
#...#...#...#..E#
#.#.#.#.#.#.#.#.#
#.#.#.#...#...#.#
#.#.#.#.###.#.#.#
#...#.#.#.....#.#
#.#.#.#.#.#####.#
#.#...#.#.#.....#
#.#.#####.#.###.#
#.#.#.......#...#
#.#.###.#####.###
#.#.#...#.....#.#
#.#.#.#####.###.#
#.#.#.........#.#
#.#.#.#########.#
#S#.............#
#################
`;

const input = readPuzzleInput('2024/day16.txt');

describe('AoC 2024, Day 16, Part 1', () => {
    it('checks the example 1', () => {
        expect(part1(example1)).toBe(7036)
    })
    it('checks the example 2', () => {
        expect(part1(example2)).toBe(11048)
    })

    it('checks the input', () => {
        expect(part1(input)).toBe(109496)
    })
});

describe('AoC 2024, Day 16, Part 2', () => {
    it('checks the example 1', () => {
        expect(part2(example1)).toBe(45)
    })
    it('checks the example 2', () => {
        expect(part2(example2)).toBe(64)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(551)
    })
});
