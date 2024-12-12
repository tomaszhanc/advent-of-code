import { describe, expect, it } from "vitest";
import {sumScoresOfAllTrailheads} from "../../src/2024/day10/solution/sumScoresOfAllTrailheads";
import {part2} from "../../src/2024/day10/solution/part2";

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
    expect(sumScoresOfAllTrailheads(input)).toBe(36)
  })

  it('part2', () => {
    expect(part2(input)).toBe(-1)
  })
});