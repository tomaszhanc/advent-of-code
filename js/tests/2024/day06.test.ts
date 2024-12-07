import {readPuzzleInput} from "../../src/shared/Input";
import {tilesVisitedByGuard} from "../../src/2024/day06/solution/part1";
import {obstaclesToLoopTheGuard} from "../../src/2024/day06/solution/part2";
import { describe, expect, it } from 'vitest'

const input = readPuzzleInput('2024/day6.txt');

describe('Input: 2024, Day 6', () => {
  it('calculates tiles visited by guard to escape the map', () => {
    expect(tilesVisitedByGuard(input)).toBe(4982)
  })

  it('calculates number of possible obstacles to plant on the map to trap the guard', () => {
    expect(obstaclesToLoopTheGuard(input)).toBe(1663)
  })
})
