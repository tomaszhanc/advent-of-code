import {Grid, isWall} from "../../shared/grid/Grid.js";
import {readByLine} from "../../shared/read.input.js";
import {Queue} from "../../shared/struct/Queue.js";
import {alreadyVisited, isEqual, Location} from "../../shared/grid/Location.js";
import {Direction} from "../../shared/grid/Direction.js";
import {Stack} from "../../shared/struct/Stack.js";
import {lastItem} from "../../shared/utils/collection.utils.js";
import {Unique} from "../../shared/grid/Unique.js";
import {printGrid} from "../../shared/utils/debug.js";

export function part1(input: string, cheatSpan: number, saveAtLeast: number): number {
    const racetrack = parsePuzzleInput(input);
    const start = racetrack.firstLocationOf('S');
    const end = racetrack.firstLocationOf('E');
    const raceCompleted = (location: Location) => isEqual(location, end);

    const fastestRouteTime = getFastestRouteWithoutCheating(start, racetrack, raceCompleted);
    return findAllCheatPaths(fastestRouteTime, saveAtLeast, racetrack);
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}

function getFastestRouteWithoutCheating(
    start: Location,
    racetrack: Grid<string>,
    raceCompleted: (location: Location) => boolean
) : Location[] {
    const queue = new Queue<Location[]>();
    const visited = new Unique();
    queue.enqueue([start]);
    visited.add(start);

    while (!queue.isEmpty()) {
        const currentPath = queue.dequeue();
        const current = lastItem(currentPath);

        if (raceCompleted(current)) {
            return currentPath;
        }

        for (const next of racetrack.nextInDirections(current, Direction.allOrthogonal())) {
            if (isWall(next) || visited.has(next.location)) {
                continue;
            }

            visited.add(next.location);
            queue.enqueue([...currentPath, next.location]);
        }
    }

    throw new Error('No route found');
}

function findAllCheatPaths(
    fastestPath: Location[],
    saveAtLeast: number,
    racetrack: Grid<string>
) : number {
    let count = 0;

    for (let i = 0; i < fastestPath.length; i++) {
        const step = fastestPath[i];

        for (const direction of Direction.allOrthogonal()) {
            const cheatStart = racetrack.nextInDirection(step, direction);
            if (cheatStart === null || !isWall(cheatStart)) continue;

            const cheatEnd = racetrack.nextInDirection(cheatStart.location, direction);
            if (cheatEnd === null || isWall(cheatEnd)) continue;

            const index = fastestPath.findIndex(location => isEqual(location, cheatEnd.location));
            if (index - i <= saveAtLeast) continue;

            count++;
        }
    }

    return count;
}