import {Direction} from "../../shared/grid/Direction.js";
import {Grid} from "../../shared/grid/Grid";
import {alreadyVisited, equals, Location} from "../../shared/grid/Position.js";
import {Queue} from "../../shared/struct/Queue.js";
import {lastItem} from "../../shared/utils/collection.utils.js";
import {cartesianProduct} from "../../shared/utils/generator.utils.js";

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

    let sum = 0;
    for (const code of codes) {
        const number = Number.parseInt(code);
        const path = findTheShortestPath(code);

        sum += (number * path.length);
    }

    return sum;
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function findTheShortestPath(code: string) : string {
    const firstRobotPaths = findAllShortestPaths([code], numericKeypad);
    const secondRobotPaths = findAllShortestPaths(firstRobotPaths, directionKeypad);
    const finalPaths = findAllShortestPaths(secondRobotPaths, directionKeypad);
    
    return finalPaths[0];
}

function findAllShortestPaths(strings: string[], keypad: Grid) : string[] {
    const paths : string[] = [];

    for (const string of strings) {
        let from = 'A';
        const pathsParts = [];

        for (const to of string) {
            pathsParts.push(findAllShortestBetweenKeys(from, to, keypad));
            from = to;
        }

        cartesianProduct(...pathsParts)
            .map(path => path.join(''))
            .forEach(path => paths.push(path));
    }

    return onlyShortestPaths(paths);
}

function findAllShortestBetweenKeys(startKey: string, endKey: string, keypad: Grid) : string[] {
    const paths : string[] = [];
    const start = keypad.firstLocationOf(startKey);
    const end = keypad.firstLocationOf(endKey);

    const queue = new Queue<[Location[], string[]]>();
    queue.enqueue([[start], []]);

    while (!queue.isEmpty()) {
        const [currentPath, currentMoves] = queue.dequeue();
        const current = lastItem(currentPath);

        if (equals(current, end)) {
            const moves = [...currentMoves, 'A'].join('');
            paths.push(moves);
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

function onlyShortestPaths(paths: string[]) : string[] {
    let minLength = Number.MAX_SAFE_INTEGER;

    for (const path of paths) {
        minLength = Math.min(minLength, path.length);
    }

    return paths.filter(path => path.length === minLength);
}