import {Direction} from "../../shared/grid/Direction.js";
import {Cell, Grid, isWall} from "../../shared/grid/Grid.js";
import {Location, nextInDirection} from "../../shared/grid/Position.js";
import {Stack} from "../../shared/struct/Stack.js";

export function part1(input: string): number {
    const [mapData, movements] = parsePuzzleInput(input);
    const map = Grid.fromString(mapData);

    return applyAllMoves(map, movements)
        .allLocationsOf('O')
        .map(location => 100 * location.y + location.x)
        .reduce((sum, boxGPS) => sum + boxGPS, 0);
}

export function part2(input: string): number {
    const [mapData, movements] = parsePuzzleInput(input);
    const map = Grid.fromString(mapData
        .replaceAll('#', '##')
        .replaceAll('O', '[]')
        .replaceAll('.', '..')
        .replaceAll('@', '@.'));

    return applyAllMoves(map, movements)
        .allLocationsOf('[')
        .map(location => 100 * location.y + location.x)
        .reduce((sum, boxGPS) => sum + boxGPS, 0);
}

function parsePuzzleInput(input: string) : [string, Direction[]]{
    let [mapData, movementsData] = input.trim().split('\n\n');

    return [
        mapData,
        movementsData.replaceAll('\n','').split('').map(direction => {
            switch (direction) {
                case '^': return Direction.UP;
                case '>': return Direction.RIGHT;
                case 'v': return Direction.DOWN;
                case '<': return Direction.LEFT;
            }

            throw new Error(`Invalid direction: ${direction}`);
        })
    ]
}

function applyAllMoves(map: Grid, movements: Direction[]) : Grid {
    for (let i = 0; i < movements.length; i++) {
        map = moveCell(map.firstLocationOf('@'), movements[i], map);
    }

    return map;
}

function moveCell(location: Location, direction: Direction, map: Grid) : Grid {
    const originalMap = map;
    const cellsToMove = new Stack<Location>();
    cellsToMove.push(location);

    while (!cellsToMove.isEmpty()) {
        const current = cellsToMove.pop();
        const nextCell = map.nextInDirection(current, direction);

        if (nextCell === null || isWall(nextCell)) {
            // Moves all cells or none
            return originalMap;
        }

        if (isBox(nextCell)) {
            cellsToMove.push(current);
            cellsToMove.push(...getBoxLocations(nextCell));
            continue;
        }

        map = map.move(current, nextCell.location);
    }

    return map;
}

function getBoxLocations(box: Cell) : Location[] {
    if (!isBox(box)) throw new Error('Not a box');

    if (box.value === 'O') {
        return [box.location];
    }

    if (box.value === '[') {
        return [box.location, nextInDirection(box.location, Direction.RIGHT)];
    }

    return [box.location, nextInDirection(box.location, Direction.LEFT)]
}

const isBox = (cell: Cell) => cell.value === 'O' || cell.value === '[' || cell.value === ']';