import {Direction} from "../../shared/grid/Direction.js";
import {Grid} from "../../shared/grid/Grid.js";
import {alreadyVisited, equals, Location} from "../../shared/grid/Position.js";
import {Queue} from "../../shared/struct/Queue.js";
import {last} from "../../shared/utils/collection.utils.js";
import {asKey} from "../../shared/utils/utils.js";

const numericKeypad = Grid.fromArray([
    ['7','8','9'],
    ['4','5','6'],
    ['1','2','3'],
    ['#','0','A']
]);
const directionKeypad = Grid.fromArray([
    ['#','^','A'],
    ['<','v','>'],
])

export function part1(input: string): number {
    const codes = input.trim().split('\n');

    return calculateComplexity(codes, 2);
}

export function part2(input: string): number {
    const codes = input.trim().split('\n');

    return calculateComplexity(codes, 25);
}

function calculateComplexity(codes: string[], numberOfRobots : number) : number {
    const shortestMoves = precalculateDirectionMoves();
    const shortestMovesLengths = precalculateDirectionMovesLengths(numberOfRobots, shortestMoves);

    let sum = 0;
    for (const code of codes) {
        const number = Number.parseInt(code);
        const pathLength = findTheShortestPath(code, shortestMovesLengths);

        sum += (number * pathLength);
    }

    return sum;
}

function precalculateDirectionMoves() : Map<string, string[]> {
    const shortestMoves = new Map<string, string[]>();

    for (const from of directionKeypad.cells.values()) {
        for (const to of directionKeypad.cells.values()) {
            if (from === '#' || to === '#') continue;

            shortestMoves.set(asKey(from, to), findAllShortestPaths(from, to, directionKeypad));
        }
    }

    return shortestMoves;
}

function precalculateDirectionMovesLengths(numberOfRobots: number, shortestMoves: Map<string, string[]>) : Map<string, number> {
    const shortestLengths = new Map<string, number>();

    for (const from of directionKeypad.cells.values()) {
        for (const to of directionKeypad.cells.values()) {
            if (from === '#' || to === '#') continue;

            let moves = shortestMoves.get(asKey(from, to));
            if (moves === undefined) throw Error(`No move found from ${from} to ${to}`);

            shortestLengths.set(
                asKey(from, to),
                shortestMovesLength(moves, numberOfRobots - 1, shortestMoves)
            );
        }
    }

    return shortestLengths;
}

const knownLengths = new Map<string, number>();
function shortestMovesLength(listOfMoves: string[], numberOfRobots: number, shortestMoves: Map<string, string[]>) : number {
    const allMovesLengths = [];

    for (const moves of listOfMoves) {
        let fromKey = 'A';
        let movesLength = 0;

        for (const toKey of moves) {
            let shortestLength = knownLengths.get(asKey(numberOfRobots.toString(), fromKey, toKey));

            if (shortestLength === undefined) {
                let keyShortestMoves = shortestMoves.get(asKey(fromKey, toKey));
                if (keyShortestMoves === undefined) throw new Error(`No moves found from ${fromKey} to ${toKey}`);
                shortestLength = keyShortestMoves[0].length;

                if (numberOfRobots > 1) {
                    shortestLength = shortestMovesLength(keyShortestMoves, numberOfRobots - 1, shortestMoves);
                }

                knownLengths.set(asKey(numberOfRobots.toString(), fromKey, toKey), shortestLength);
            }

            fromKey = toKey;
            movesLength += shortestLength;
        }

        allMovesLengths.push(movesLength);
    }

    return Math.min(...allMovesLengths);
}

function findTheShortestPath(code: string, movesLengths: Map<string, number>) : number {
    let totalShortestLength : number = 0;
    let fromCode = 'A';

    for (const toCode of code) {
        const firstRobotPaths = findAllShortestPaths(fromCode, toCode, numericKeypad);
        const firstRobotPathsLengths = [];

        for (const firstRobotPath of firstRobotPaths) {
            let fromKey = 'A';
            let firstRobotPathLength = 0;
            for (const toKey of firstRobotPath) {
                let shortest = movesLengths.get(asKey(fromKey, toKey));
                if (shortest === undefined) throw new Error(`No possible moves found from ${fromKey} to ${toKey}`);

                fromKey = toKey;
                firstRobotPathLength += shortest;
            }

            firstRobotPathsLengths.push(firstRobotPathLength);
        }

        fromCode = toCode;
        totalShortestLength += Math.min(...firstRobotPathsLengths);
    }

    return totalShortestLength;
}

function findAllShortestPaths(startKey: string, endKey: string, keypad: Grid) : string[] {
    const paths : string[] = [];
    const start = keypad.firstLocationOf(startKey);
    const end = keypad.firstLocationOf(endKey);

    const queue = new Queue<[Location[], string[]]>();
    queue.enqueue([[start], []]);

    while (!queue.isEmpty()) {
        const [currentPath, currentMoves] = queue.dequeue();
        const current = last(currentPath);

        if (equals(current, end)) {
            paths.push([...currentMoves, 'A'].join(''));
            continue;
        }

        for (const direction of Direction.allOrthogonal()) {
            const next = keypad.nextInDirection(current, direction);
            if (next === null || next.value === '#' || alreadyVisited(next.location, currentPath)) {
                continue;
            }

            if (paths.length > 0 && currentPath.length > paths[0].length) {
                continue;
            }

            queue.enqueue([
                [...currentPath, next.location],
                [...currentMoves, directionToString(direction)]
            ]);
        }
    }

    return paths;
}

function directionToString(direction: Direction) : string {
    switch (direction) {
        case Direction.UP: return '^';
        case Direction.DOWN: return 'v';
        case Direction.LEFT: return '<';
        case Direction.RIGHT: return '>';
    }

    throw new Error(`Invalid direction: ${direction}`);
}