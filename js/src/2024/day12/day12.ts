import {Direction, directionToString} from "../../shared/grid/Direction.js";
import {Grid} from "../../shared/grid/Grid.js";
import {Location, locationToString, nextInDirection} from "../../shared/grid/Position.js";
import {Visited} from "../../shared/grid/Visited.js";
import {Queue} from "../../shared/struct/Queue.js";

export function part1(input: string): number {
    const grid = Grid.fromString(input);
    const visited = new Visited<Location>()
    let totalPerimeterProduct = 0;

    grid.forEach((_, location) => {
        if (!visited.has(location)) {
            const [area, perimeter] = floodFill(location, visited, grid);
            totalPerimeterProduct += area * perimeter;
        }
    });

    return totalPerimeterProduct;
}

export function part2(input: string): number {
    const grid = Grid.fromString(input);
    let totalSideProduct = 0;
    const visited = new Visited<Location>()

    grid.forEach((_, location) => {
        if (!visited.has(location)) {
            const [area, _, perimeterMap] = floodFill(location, visited, grid);
            const sides = countSides(perimeterMap);
            totalSideProduct += area * sides;
        }
    });

    return totalSideProduct;
}

type PerimeterMap = Map<string, Set<string>>;

const floodFill = (start: Location, visited: Visited<Location>, grid: Grid): [area: number, perimeter: number, perimeterMap: PerimeterMap] => {
    const perimeterMap: PerimeterMap = new Map();
    let area = 0;
    let perimeter = 0;

    const queue = new Queue<Location>;
    queue.enqueue(start);

    while (!queue.isEmpty()) {
        const currentLocation = queue.dequeue();

        if (visited.has(currentLocation)) continue;
        visited.add(currentLocation);
        area++;

        for (const direction of Direction.allOrthogonal()) {
            const next = grid.nextInDirection(currentLocation, direction);

            if (next !== null && next.value === grid.valueAt(start)) {
                queue.enqueue(next.location);
                continue;
            }

            perimeter++;
            const directionKey = directionToString(direction);
            if (!perimeterMap.has(directionKey)) {
                perimeterMap.set(directionKey, new Set());
            }

            perimeterMap.get(directionKey)!.add(locationToString(currentLocation));
        }
    }

    return [area, perimeter, perimeterMap];
};

const countSides = (perimeterMap: PerimeterMap): number => {
    let sides = 0;

    for (const locationStrings of perimeterMap.values()) {
        const visited = new Visited<Location>()

        for (const locationString of locationStrings) {
            const location = Location.fromString(locationString);
            if (visited.has(location)) continue;

            sides++;
            const queue = new Queue<Location>();
            queue.enqueue(location);

            while (!queue.isEmpty()) {
                const currentLocation = queue.dequeue();
                if (visited.has(currentLocation)) continue;

                visited.add(currentLocation);
                for (const direction of Direction.allOrthogonal()) {
                    const next = nextInDirection(currentLocation, direction);
                    if (locationStrings.has(locationToString(next))) {
                        queue.enqueue(next);
                    }
                }
            }
        }
    }

    return sides;
};