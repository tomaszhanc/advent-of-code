import {Cell, Grid} from "../../shared/grid/Grid";
import {readByLine} from "../../shared/read.input";
import {isEqual, Location} from "../../shared/grid/Location";
import {Direction} from "../../shared/grid/Direction";
import {findShortestPath} from "../../shared/grid/search/bfs";
import {getNeighbors} from "../../shared/grid/search/search";

export function part1(input: string, memorySize: number, simulationSize : number): number {
    const listOfBytes = parsePuzzleInput(input);
    const memorySpace = Grid
        .empty<string>(memorySize, memorySize)
        .setValue('#', ...listOfBytes.slice(0, simulationSize));

    const start = {x:0,y:0};
    const end = {x:memorySize-1,y:memorySize-1};
    const shortestPath = findShortestPath(
        start,
        memorySpace,
        getNeighbors(Direction.allOrthogonal(), (cell) => cell.value !== '#'),
        (cell) => isEqual(cell.location, end)
    );

    return shortestPath.length - 1;
}

export function part2(memorySize: number, input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) {
    return readByLine(input).map(line => Location.fromString(line));
}
