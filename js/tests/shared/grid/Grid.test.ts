import {describe, expect, it} from 'vitest'
import {Grid} from "../../../src/shared/grid/Grid";
import {Location} from "../../../src/shared/grid/Location";

describe('Grid Tests', () => {
    const grid = Grid.empty(3, 3);

    const validLocations = [
        {x: 0, y: 0}, {x: 1, y: 0}, {x: 2, y: 0},
        {x: 0, y: 1}, {x: 1, y: 1}, {x: 2, y: 1},
        {x: 0, y: 2}, {x: 1, y: 2}, {x: 2, y: 2}
    ];

    it.each(validLocations)('checks if %s is within bounds', (location: Location) => {
        expect(grid.hasInBounds(location)).toBe(true);
    });

    const inValidLocations = [
        { x: 0, y: -1}, { x: 1, y: -1}, { x: 2, y: -1},

        {x: -1, y: -1}, { x: 3, y: -1},
        {x: -1, y:  0}, { x: 3, y:  0},
        {x: -1, y:  1}, { x: 3, y:  1},
        {x: -1, y:  2}, { x: 3, y:  2},
        {x: -1, y:  3}, { x: 3, y:  3},

        { x: 0, y: 3}, { x: 1, y: 3}, { x: 2, y: 3},
    ];

    it.each(inValidLocations)('checks if %s is out of bounds', (location: Location) => {
        expect(grid.hasInBounds(location)).toBe(false);
    });
});