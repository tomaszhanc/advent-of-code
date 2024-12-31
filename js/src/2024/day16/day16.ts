import {Grid, isWall} from "../../shared/grid/Grid";
import {isEqual, Location, locationToString} from "../../shared/grid/Position.js";
import {Direction, rotateClockwise, rotateCounterclockwise} from "../../shared/grid/Direction";
import {PriorityQueue} from "../../shared/struct/PriorityQueue";
import {lastItem} from "../../shared/utils/collection.utils";

export function part1(input: string): number {
    const maze = Grid.fromString(input);

    return findPathToEscapeTheMaze(maze).score;
}

export function part2(input: string): number {
    const maze = Grid.fromString(input);

    return 0;
}

type ReindeerPosition = {
    location: Location,
    direction: Direction
}

type ReindeerPath = {
    path: ReindeerPosition[],
    score: number,
}

function findPathToEscapeTheMaze(maze: Grid) : ReindeerPath {
    const start = maze.firstPositionOf('S');
    const end = maze.firstPositionOf('E');
    const startingPosition = { location: start, direction: Direction.RIGHT };

    const queue = new PriorityQueue<ReindeerPath>();
    queue.enqueue({ path: [startingPosition], score: 0 });

    const visited = new Set<string>();
    visited.add(toString(startingPosition));

    while (!queue.isEmpty()) {
        const currentPath = queue.dequeue();
        const currentPosition = lastItem(currentPath.path);
        visited.add(toString(currentPosition));

        if (isEqual(currentPosition.location, end)) {
            return currentPath;
        }

        for (let [nextPosition, score] of possibleMoves(currentPosition, maze)) {
            if (visited.has(toString(nextPosition))) {
                continue;
            }

            queue.enqueue(addNextPosition(currentPath, nextPosition, score));
        }
    }

    throw new Error('Reindeer got stack in the maze!');
}

function* possibleMoves(position: ReindeerPosition, maze: Grid) : Generator<[ReindeerPosition, number]> {
    const rules = [
        { direction: position.direction, score: 1},
        { direction: rotateClockwise(position.direction), score: 1001},
        { direction: rotateCounterclockwise(position.direction), score: 1001},
    ];

    for (let rule of rules) {
        const nextMove = maze.nextInDirection(position.location, rule.direction);
        if (nextMove === null || isWall(nextMove)) continue;

        yield [
            { location: nextMove.location, direction: rule.direction },
            rule.score
        ];
    }
}

const toString = (position: ReindeerPosition) => `${locationToString(position.location)}-d${position.direction}`;
const addNextPosition = (path: ReindeerPath, position: ReindeerPosition, score: number) => {
    return { path: [...path.path, position], score: path.score + score };
}