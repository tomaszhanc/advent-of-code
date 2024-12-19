import {Grid} from "../../shared/grid/Grid";
import {readByLine} from "../../shared/read.input";
import {isEqual, Location, locationToString} from "../../shared/grid/Location";
import {Direction, rotateClockwise, rotateCounterclockwise} from "../../shared/grid/Direction";
import {PriorityQueue} from "../../shared/struct/PriorityQueue";
import {lastItem} from "../../shared/utils/collection.utils";
import {Stack} from "../../shared/struct/Stack";

export function part1(input: string): number {
    const maze = parsePuzzleInput(input);

    const all = Array.from(dfs(maze));

    return 0;
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}

type ReindeerPosition = {
    location: Location,
    direction: Direction
}

type ReindeerPath = {
    path: ReindeerPosition[],
    score: number,
}

function* findPathToEscapeTheMaze(maze: Grid<string>) : Generator<ReindeerPath> {
    const start = maze.firstLocationOf('S');
    const end = maze.firstLocationOf('E');
    const startingPosition = { location: start, direction: Direction.RIGHT };
    const escapedTheMaze = (position: ReindeerPosition) => isEqual(position.location, end);

    const visited = new Set<string>();
    visited.add(toString(startingPosition));

    const queue = new PriorityQueue<ReindeerPath>();
    queue.enqueue({ path: [startingPosition], score: 0 });

    while (!queue.isEmpty()) {
        const currentPath = queue.dequeue();
        const currentPosition = lastItem(currentPath.path);

        if (escapedTheMaze(currentPosition)) {
            yield currentPath;
        }

        for (let [nextPosition, score] of possibleMoves(currentPosition, maze)) {
            // if (visited.has(toString(nextPosition))) {
            //     continue;
            // }

            visited.add(toString(nextPosition));
            queue.enqueue(addNextPosition(currentPath, nextPosition, score));
        }
    }

    // throw new Error('Reindeer got stack in the maze!');
}

function* dfs(maze: Grid<string>) : Generator<ReindeerPath> {
    const start = maze.firstLocationOf('S');
    const end = maze.firstLocationOf('E');
    const startingPosition = { location: start, direction: Direction.RIGHT };
    const escapedTheMaze = (position: ReindeerPosition) => isEqual(position.location, end);

    // const visited = new Set<string>();
    // visited.add(toString(startingPosition));

    const stack = new Stack<ReindeerPath>();
    stack.push({ path: [startingPosition], score: 0 });

    while (!stack.isEmpty()) {
        const currentPath = stack.pop();
        const currentPosition = lastItem(currentPath.path);

        if (escapedTheMaze(currentPosition)) {
            yield currentPath;
        }

        for (let [nextPosition, score] of possibleMoves(currentPosition, maze)) {
            // if (visited.has(toString(nextPosition))) {
            //     continue;
            // }

            // visited.add(toString(nextPosition));
            stack.push(addNextPosition(currentPath, nextPosition, score));
        }
    }

    // throw new Error('Reindeer got stack in the maze!');
}

function* possibleMoves(position: ReindeerPosition, maze: Grid<string>) : Generator<[ReindeerPosition, number]> {
    const rules = [
        { direction: position.direction, score: 1},
        { direction: rotateClockwise(position.direction), score: 1001},
        { direction: rotateCounterclockwise(position.direction), score: 1001},
    ];

    for (let rule of rules) {
        const next = maze.nextInDirection(position.location, rule.direction);

        if (next === null || next.value !== '#') {
            yield [{ location: next!.location, direction: rule.direction }, rule.score];
        }

    }
}

const toString = (position: ReindeerPosition) => `${locationToString(position.location)}-d${position.direction}`;
const addNextPosition = (path: ReindeerPath, position: ReindeerPosition, score: number) => {
    return { path: [...path.path, position], score: path.score + score };
}