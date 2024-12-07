import {Input} from "../../src/shared/Input";
import {parsePuzzleInput} from "../../src/2024/day06/solution/parsePuzzleInput";
import {tilesVisitedByGuard} from "../../src/2024/day06/solution/part1";
import {obstaclesToLoopTheGuard} from "../../src/2024/day06/solution/part2";
import { describe, expect, it } from 'vitest'

let [guardPosition, map] = parsePuzzleInput(new Input(`
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
`));

describe('AoC 2024, Day 6, Example', () => {
  it('calculates tiles visited by guard to escape the map', () => {
    expect(tilesVisitedByGuard(guardPosition, map)).toBe(41)
  })

  it('calculates number of possible obstacles to plant on the map to trap the guard', () => {
    expect(obstaclesToLoopTheGuard(guardPosition, map)).toBe(6)
  })
});
