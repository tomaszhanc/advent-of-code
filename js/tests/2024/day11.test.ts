import { describe, expect, it } from "vitest";
import {numberOfStonesAfterBlinks} from "../../src/2024/day11/solution/numberOfStonesAfterBlinks";

const input = `9694820 93 54276 1304 314 664481 0 4`;

describe('AoC 2024, Day 11', () => {
  it('number of stones after 25 blinks', () => {
    expect(numberOfStonesAfterBlinks(25, input)).toBe(185894)
  })

  it('number of stones after 75 blinks', () => {
    expect(numberOfStonesAfterBlinks(75, input)).toBe(221632504974231)
  })
});