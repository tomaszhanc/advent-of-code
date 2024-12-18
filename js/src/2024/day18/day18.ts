import {Grid} from "../../shared/grid/Grid";
import {readByLine} from "../../shared/read.input";
import {isEqual, Location, locationToString} from "../../shared/grid/Location";
import {Direction} from "../../shared/grid/Direction";
import {Queue} from "../../shared/struct/Queue";
import {lastItem} from "../../shared/utils/collection.utils";

export function part1(input: string, memorySize: number, simulationSize : number): number {
    const listOfBytes = parsePuzzleInput(input);
    const memorySpace = Grid
        .empty<string>(memorySize, memorySize)
        .setValue('#', ...listOfBytes.slice(0, simulationSize));

    return findShortestPath(memorySpace).length - 1;
}

export function part2(input: string, memorySize: number, lastValidSimulationSize: number): string {
    const listOfBytes = parsePuzzleInput(input);
    let memorySpace = Grid
        .empty<string>(memorySize, memorySize)
        .setValue('#', ...listOfBytes.slice(0, lastValidSimulationSize));

    for (let byte of listOfBytes.slice(lastValidSimulationSize)) {
        memorySpace = memorySpace.setValue('#', byte);

        if (findShortestPath(memorySpace).length === 0) {
            return locationToString(byte);
        }
    }

    throw Error('All good.... or not?');
}

function parsePuzzleInput(input: string) {
    return readByLine(input).map(line => Location.fromString(line));
}

function findShortestPath(memorySpace: Grid<string>) : Location[] {
    const start = { x:0, y:0 };
    const end = { x:memorySpace.width-1, y:memorySpace.height-1 };

    const visited = new Set<string>;
    visited.add(locationToString(start))
    const queue = new Queue<Location[]>();
    queue.enqueue([start]);

    while (!queue.isEmpty()) {
        const currentPath = queue.dequeue();
        const current = lastItem(currentPath);

        for (let next of memorySpace.nextInDirections(current, Direction.allOrthogonal())) {
            if (isEqual(next.location, end)) {
                return [...currentPath, next.location];
            }

            if (next.value === '#' || visited.has(locationToString(next.location))) {
                continue;
            }

            visited.add(locationToString(next.location));
            queue.enqueue([...currentPath, next.location]);
        }
    }

    return [];
}