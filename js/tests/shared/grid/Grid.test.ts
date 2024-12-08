import {describe, expect, it} from 'vitest'
import {Grid} from "../../../src/shared/grid/Grid";
import {Location} from "../../../src/shared/grid/Location";

describe('???', () => {
    const grid = Grid.empty(3, 3);

    const validLocations = [
        new Location(0, 0),
        new Location(1, 0),
        new Location(2, 0),
        new Location(0, 1),
        new Location(1, 1),
        new Location(2, 1),
        new Location(0, 2),
        new Location(1, 2),
        new Location(2, 2),
    ];

    it.each(validLocations)('checks if %s is within bounds', (location: Location) => {
        expect(grid.hasInBounds(location)).toBe(true);
    });

    const inValidLocations = [
        new Location(-1, -1),
        new Location(-1,  0),
        new Location(-1,  1),
        new Location(-1,  2),
        new Location(-1,  3),

        new Location(3, -1),
        new Location(3,  0),
        new Location(3,  1),
        new Location(3,  2),
        new Location(3,  3),

        new Location(0, -1),
        new Location(1, -1),
        new Location(2, -1),

        new Location(0, 3),
        new Location(1, 3),
        new Location(2, 3),
    ];

    it.each(inValidLocations)('checks if %s is out of bounds', (location: Location) => {
        expect(grid.hasInBounds(location)).toBe(false);
    });
});