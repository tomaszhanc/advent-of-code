import {Grid, isWall} from "../../shared/grid/Grid.js";
import {readByLine} from "../../shared/read.input.js";
import {Queue} from "../../shared/struct/Queue.js";
import {distanceBetween, isEqual, Location} from "../../shared/grid/Location.js";
import {Direction} from "../../shared/grid/Direction.js";
import {lastItem} from "../../shared/utils/collection.utils.js";
import {Unique} from "../../shared/grid/Unique.js";

export function part1(input: string, cheatSpan: number, saveAtLeast: number): number {
    const racetrack = parsePuzzleInput(input);
    const start = racetrack.firstLocationOf('S');
    const end = racetrack.firstLocationOf('E');

    const fastestRouteTime = getFastestRouteWithoutCheating(start, end, racetrack);
    return findAllCheats(fastestRouteTime, cheatSpan, saveAtLeast);
}

function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}

function getFastestRouteWithoutCheating(start: Location, end: Location, racetrack: Grid<string>) : Location[] {
    const queue = new Queue<Location[]>();
    const visited = new Unique();
    queue.enqueue([start]);
    visited.add(start);

    while (!queue.isEmpty()) {
        const currentPath = queue.dequeue();
        const current = lastItem(currentPath);

        if (isEqual(current, end)) {
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

function findAllCheats(fastestPath: Location[], cheatSpan: number, saveAtLeast: number) : number {
    let count = 0;

    for (let i = 0; i < fastestPath.length; i++) {
        const cheatStart = fastestPath[i];

        for (let j = i + saveAtLeast; j < fastestPath.length; j++) {
            const cheatEnd = fastestPath[j];
            const distance = distanceBetween(cheatStart, cheatEnd);
            const totalDistance = Math.abs(distance.dX) + Math.abs(distance.dY);
            if (totalDistance > cheatSpan) continue;

            if (j - i - totalDistance >= saveAtLeast) {
                count++;
            }
        }
    }

    return count;
}