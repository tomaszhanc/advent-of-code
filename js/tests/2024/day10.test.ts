import {readPuzzleInput} from "../../src/shared/read.input";
import { describe, expect, it } from "vitest";
import {
  sumRanksOfAllTrailheads,
  sumScoreOfAllTrailheads
} from "../../src/2024/day10/solution/trails";

const input = readPuzzleInput('2024/day10.txt')

describe('AoC 2024, Day 10', () => {
  it('sums the scores of all trailheads', () => {
    expect(sumScoreOfAllTrailheads(input)).toBe(552)
  })

  it('sums the ranks of all trailheads', () => {
    expect(sumRanksOfAllTrailheads(input)).toBe(1225)
  })
});