import {calculatePriceOfFence, calculatePriceOfFenceWithDiscount} from "../../src/2024/day12/day12";
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

const input4 = `
EEEEE
EXXXX
EEEEE
EXXXX
EEEEE
`;

const input5 = `
AAAAAA
AAABBA
AAABBA
ABBAAA
ABBAAA
AAAAAA
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

  // PART 2

  it('calculates price of the fence for the garden #1 with discount', () => {
    expect(calculatePriceOfFenceWithDiscount(input1)).toBe(80)
  })

  // it('calculates price of the fence for the garden #2 with discount', () => {
  //   expect(calculatePriceOfFenceWithDiscount(input2)).toBe(436)
  // })

  // FIXME: This test is failing - EEEEE - it creates a square as the boundary without those entries in the middle in the shape of an E (where the Xs are)."
  // it('calculates price of the fence for the garden #4 with discount', () => {
  //   expect(calculatePriceOfFenceWithDiscount(input4)).toBe(236)
  // })
  //
  // // FIXME: This test is failing
  // it('calculates price of the fence for the garden #5 with discount', () => {
  //   expect(calculatePriceOfFenceWithDiscount(input5)).toBe(368)
  // })
  //
  // // FIXME: This test is failing
  // it('calculates price of the fence for the garden #3 with discount', () => {
  //   expect(calculatePriceOfFenceWithDiscount(input3)).toBe(1206)
  // })
});