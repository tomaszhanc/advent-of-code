import {Grid, isWall} from "../../shared/grid/Grid.js";
import {readByLine} from "../../shared/read.input.js";
import {Queue} from "../../shared/struct/Queue.js";
import {alreadyVisited, isEqual, Location} from "../../shared/grid/Location.js";
import {Direction} from "../../shared/grid/Direction.js";
import {Stack} from "../../shared/struct/Stack.js";
import {lastItem} from "../../shared/utils/collection.utils.js";
import {Unique} from "../../shared/grid/Unique.js";
import {printGrid} from "../../shared/utils/debug.js";

export function part1(saveAtLeast: number, input: string): number {
    const racetrack = parsePuzzleInput(input);
    const start = racetrack.firstLocationOf('S');
    const end = racetrack.firstLocationOf('E');
    const raceCompleted = (location: Location) => isEqual(location, end);

    const fastestRouteTime = getTimeForFastestRouteWithoutCheating(start, racetrack, raceCompleted);

    return findAllCheatPathsBetterThan(fastestRouteTime - saveAtLeast, start, racetrack, raceCompleted);
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}

function getTimeForFastestRouteWithoutCheating(
    start: Location,
    racetrack: Grid<string>,
    raceCompleted: (location: Location) => boolean
) : number {
    const queue = new Queue<Location[]>();
    const visited = new Unique();
    queue.enqueue([start]);
    visited.add(start);

    while (!queue.isEmpty()) {
        const currentPath = queue.dequeue();
        const current = lastItem(currentPath);

        if (raceCompleted(current)) {
            return currentPath.length - 1;
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

type RacePath = {
    path: Location[],
    cheated: boolean
}

function findAllCheatPathsBetterThan(
    maxTime: number,
    start: Location,
    racetrack: Grid<string>,
    raceCompleted: (location: Location) => boolean,
) : number {
    const stack = new Stack<RacePath>();
    const allCheatPaths = new Unique<Location[]>();

    stack.push({ path: [start], cheated: false});

    let i =0;

    while (!stack.isEmpty()) {
        i++;
        const currentPath = stack.pop();
        const current = lastItem(currentPath.path);

        if (currentPath.path.length-1 > maxTime) {
            continue;
        }

        if (raceCompleted(current)) {
            if (currentPath.cheated) {
                allCheatPaths.add(currentPath.path);
            }
            continue;
        }

        for (const direction of Direction.allOrthogonal()) {
            const next = racetrack.nextInDirection(current, direction);

            if (next === null || alreadyVisited(next.location, currentPath.path)) {
                continue;
            }

            let alreadyCheated = currentPath.cheated;
            if (isWall(next)) {
                if (alreadyCheated || !isThereMoveAfter(next.location, direction, racetrack)) {
                    continue;
                }

                alreadyCheated = true;
            }

            stack.push({path: [...currentPath.path, next.location], cheated: alreadyCheated });
        }
    }

    return allCheatPaths.size();
}


function isThereMoveAfter(location: Location, direction: Direction, racetrack: Grid<string>) : boolean {
    const next = racetrack.nextInDirection(location, direction);

    return next !== null && !isWall(next);
}
