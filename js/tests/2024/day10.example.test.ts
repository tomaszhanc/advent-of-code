import { describe, expect, it } from "vitest";
import { sumRanksOfAllTrailheads, sumScoreOfAllTrailheads } from "../../src/2024/day10/solution/trails";

const input = `
89010123
78121874
87430965
96549874
45678903
32019012
01329801
10456732
`;

describe('AoC 2024, Day 10, Example', () => {
  it('sums the scores of all trailheads', () => {
    expect(sumScoreOfAllTrailheads(input)).toBe(36)
  })

  it('sums the ranks of all trailheads', () => {
    expect(sumRanksOfAllTrailheads(input)).toBe(81)
  })
});