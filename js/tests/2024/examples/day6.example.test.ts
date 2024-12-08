import {tilesVisitedByGuard} from "../../../src/2024/day6/solution/tilesVisitedByGuard";
import {obstaclesToLoopTheGuard} from "../../../src/2024/day6/solution/obstaclesToLoopTheGuard";
import {describe, expect, it} from 'vitest'

const input = `
....#.....
.........#
..........
..#.......
.......#..
..........
.#..^.....
........#.
#.........
......#...
`;

describe('AoC 2024, Day 6, Example', () => {
    it('calculates tiles visited by guard to escape the map', () => {
        expect(tilesVisitedByGuard(input)).toBe(41)
    })

    it('calculates number of possible obstacles to plant on the map to trap the guard', () => {
        expect(obstaclesToLoopTheGuard(input)).toBe(6)
    })
});
