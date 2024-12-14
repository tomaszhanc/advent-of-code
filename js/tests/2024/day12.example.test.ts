import {calculatePriceOfFence} from "../../src/2024/day12/day12";
import { describe, expect, it } from "vitest";

const input1 = `
AAAA
BBCD
BBCC
EEEC
`;

const input2 = `
OOOOO
OXOXO
OOOOO
OXOXO
OOOOO
`;

const input3 = `
RRRRIICCFF
RRRRIICCCF
VVRRRCCFFF
VVRCCCJFFF
VVVVCJJCFE
VVIVCCJJEE
VVIIICJJEE
MIIIIIJJEE
MIIISIJEEE
MMMISSJEEE
`;

describe('AoC 2024, Day 12, Example', () => {
  it('calculates price of the fence for the garden #1', () => {
    expect(calculatePriceOfFence(input1)).toBe(140)
  })

  it('calculates price of the fence for the garden #2', () => {
    expect(calculatePriceOfFence(input2)).toBe(772)
  })

  it('calculates price of the fence for the garden #3', () => {
    expect(calculatePriceOfFence(input3)).toBe(1930)
  })


  // it('part2', () => {
  //   expect(part2(input)).toBe(-1)
  // })
});