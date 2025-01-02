import {Stack} from "../../struct/Stack.js";
import {isEqual, Location, locationToString} from "../Position.js";
import {lastItem} from "../../utils/collection.utils.js";
import {Cell, Grid} from "../Grid.js";
import {Direction} from "../Direction.js";

export type Path = Cell[];

export function findLongestPath(
    start: Location,
    grid: Grid,
    getNeighbors: (step: Cell, grid: Grid) => Cell[],
    isTraverseCompleted: (step: Cell, path: Path, neighbors: Cell[]) => boolean = (_, __, neighbors) => neighbors.length === 0
) : Path {
    let longestPath : Path = [];

    for (let path of dfs(start, grid, getNeighbors, isTraverseCompleted)) {
        if (path.length > longestPath.length) {
            longestPath = path;
        }
    }

    return longestPath;
}

export function findAllSameValueAdjacentCells(
    start: Location,
    grid: Grid,
    adjacencyDirections: Direction[] = Direction.allOrthogonal()
) : Path {
    const neighbors = (step: Cell, grid: Grid): Cell[] =>
        grid.nextInDirections(step.location, adjacencyDirections)
            .filter(cell => cell.value === step.value)

    const group = new Set<string>();
    for (let path of dfsVisitingOnce(start, grid, neighbors)) {
        path.forEach(step => group.add(JSON.stringify(step)));
    }

    return Array.from(group).map(object => JSON.parse(object));
}

/**
 * Traverse all available paths, avoiding cycles and visiting each cell only once.
 *
 * By default, it traverses until all neighbors are visited. You can pass a custom `isTraverseCompleted`
 * function to stop the traversal at a specific step.
 */
export function* dfsVisitingOnce(
    start: Location,
    grid: Grid,
    getNeighbors: (step: Cell, grid: Grid) => Cell[],
    isTraverseCompleted: (step: Cell, path: Path, neighbors: Cell[]) => boolean = (_, __, neighbors) => neighbors.length === 0
): Generator<Path> {
    return yield* dfs(
        start, grid, getNeighbors, isTraverseCompleted,
        (step, visited) => !visited.has(locationToString(step.location))
    );
}

/**
 * Traverse all available paths, avoiding cycles.
 *
 * By default, it traverses:
 *  - until all neighbors are visited. You can pass a custom `isTraverseCompleted` function
 *    to stop the traversal at a specific step.
 *  - all steps, even if they were already visited. You can pass a custom `shouldTraverse` function
 *    to avoid visiting some steps.
 */
export function* dfs(
    start: Location,
    grid: Grid,
    getNeighbors: (step: Cell, grid: Grid) => Cell[],
    isTraverseCompleted: (step: Cell, path: Path, neighbors: Cell[]) => boolean = (_, __, neighbors) => neighbors.length === 0,
    shouldVisit: (step: Cell, visited: Set<string>) => boolean = () => true
): Generator<Path> {
    const visited = new Set<string>();
    visited.add(locationToString(start));

    const stack = new Stack<Path>();
    stack.push([grid.cellAt(start)]);

    while (!stack.isEmpty()) {
        const path = stack.pop();
        const step = lastItem(path);
        const neighbors = getNeighbors(step, grid)
            .filter(neighbor => !isAlreadyInPath(neighbor, path))
            .filter(neighbor => shouldVisit(neighbor, visited));

        if (isTraverseCompleted(step, path, neighbors)) {
            yield path;
            continue;
        }

        for (const neighbor of neighbors) {
            visited.add(locationToString(neighbor.location));
            stack.push([...path, neighbor]);
        }
    }
}

function isAlreadyInPath(step: Cell, path: Path) {
    return path.some(next => isEqual(next.location, step.location));
}