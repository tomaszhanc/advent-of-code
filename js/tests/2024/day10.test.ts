import {readPuzzleInput} from "../../src/shared/read.input";
import { describe, expect, it } from "vitest";
import {sumScoresOfAllTrailheads} from "../../src/2024/day10/solution/sumScoresOfAllTrailheads";

const input = readPuzzleInput('2024/day10.txt')

describe('AoC 2024, Day 10', () => {
  it('sums the scores of all trailheads', () => {
    expect(sumScoresOfAllTrailheads(input)).toBe(552)
  })
});