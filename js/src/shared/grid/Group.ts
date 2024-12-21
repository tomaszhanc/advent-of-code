import {Location, locationToString} from "./Location.js";
import {Grid} from "./Grid.js";
import {findAllSameValueAdjacentCells} from "./search/dfs.js";
import {Direction} from "./Direction.js";

export type Group<T> = {
    readonly key: T,
    readonly locations: Location[]
}

export function groupByValue<T>(grid: Grid<T>): Group<T>[] {
    const groups = new Map<T, Location[]>();

    for (const [location, value] of grid.cells.entries()) {
        if (!groups.has(value)) {
            groups.set(value, []);
        }

        groups.get(value)!.push(Location.fromString(location));
    }

    return Array.from(groups).map(([key, locations]) => ({key, locations}));
}

export function* groupByAdjacentValues<T>(
    grid: Grid<T>,
    ...directions: Direction[]
): Generator<Group<T>> {
    const visited = new Set<string>();

    for (const [location, value] of grid.cells.entries()) {
        if (visited.has(location)) {
            continue;
        }

        visited.add(location);

        const group = findAllSameValueAdjacentCells(Location.fromString(location), grid, directions);

        yield {
            key: value,
            locations: group.map(step => step.location)
        }

        group.forEach(step => visited.add(locationToString(step.location)));
    }
}