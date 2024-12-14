import {Location, locationAsString, nextInDirections} from "./Location";
import {Grid, GridType} from "./Grid";
import {Step, traverseAllOnceFrom} from "./search/DFS";
import {Direction} from "./Direction";

export type Group<T extends GridType> = {
    readonly key: T,
    readonly locations: Location[]
}

export function groupByValue<T extends GridType>(grid: Grid<T>): Group<T>[] {
    const groups = new Map<T, Location[]>();

    for (const [location, value] of grid.cells.entries()) {
        if (!groups.has(value)) {
            groups.set(value, []);
        }

        groups.get(value)!.push(Location.fromString(location));
    }

    return Array.from(groups).map(([key, locations]) => ({key, locations}));
}

export function* groupByAdjacentValues<T extends GridType>(
    grid: Grid<T>,
    ...directions: Direction[]
): Generator<Group<T>> {
    const visited = new Set<string>();

    for (const [location, value] of grid.cells.entries()) {
        if (visited.has(location)) {
            continue;
        }

        visited.add(location);
        let step = { location: Location.fromString(location), value };
        let group = [];

        for (let path of traverseAllOnceFrom(step, getNeighbors(grid, directions))) {
            group.push(...path.map(step => locationAsString(step.location)));
        }

        yield {
            key: value,
            locations: Array.from(new Set(group)).map(Location.fromString)
        }

        group.forEach(location => visited.add(location));
    }
}

export function getNeighbors<T extends GridType>(
    grid: Grid<T>,
    directions: Direction[]
) {
    return (step: Step<T>): Step<T>[] =>
        nextInDirections(step.location, ...directions)
            .filter(location => grid.hasInBounds(location) && grid.valueAt(location) === step.value)
            .map(location => ({ location, value: step.value }));
}