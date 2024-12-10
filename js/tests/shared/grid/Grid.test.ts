import {describe, expect, it} from 'vitest'
import {Grid} from "../../../src/shared/grid/Grid";
import {Location} from "../../../src/shared/grid/Location";

describe('Grid Tests', () => {
    const grid = Grid.empty(3, 3);

    const validLocations = [
        Location.create(0, 0),
        Location.create(1, 0),
        Location.create(2, 0),
        Location.create(0, 1),
        Location.create(1, 1),
        Location.create(2, 1),
        Location.create(0, 2),
        Location.create(1, 2),
        Location.create(2, 2),
    ];

    it.each(validLocations)('checks if %s is within bounds', (location: Location) => {
        expect(grid.hasInBounds(location)).toBe(true);
    });

    const inValidLocations = [
        Location.create(-1, -1),
        Location.create(-1,  0),
        Location.create(-1,  1),
        Location.create(-1,  2),
        Location.create(-1,  3),

        Location.create(3, -1),
        Location.create(3,  0),
        Location.create(3,  1),
        Location.create(3,  2),
        Location.create(3,  3),

        Location.create(0, -1),
        Location.create(1, -1),
        Location.create(2, -1),

        Location.create(0, 3),
        Location.create(1, 3),
        Location.create(2, 3),
    ];

    it.each(inValidLocations)('checks if %s is out of bounds', (location: Location) => {
        expect(grid.hasInBounds(location)).toBe(false);
    });
});