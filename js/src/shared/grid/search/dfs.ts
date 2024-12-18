import {Stack} from "../../struct/Stack";
import {isEqual, Location, locationAsString} from "../Location";
import {lastItem} from "../../utils/collection.utils";
import {Cell, Grid} from "../Grid";
import {Direction} from "../Direction";

export type Path<T> = Cell<T>[];

export function findLongestPath<T>(
    start: Location,
    grid: Grid<T>,
    getNeighbors: (step: Cell<T>, grid: Grid<T>) => Cell<T>[],
    isTraverseCompleted: (step: Cell<T>, path: Path<T>, neighbors: Cell<T>[]) => boolean = (_, __, neighbors) => neighbors.length === 0
) : Path<T> {
    let longestPath : Path<T> = [];

    for (let path of dfs(start, grid, getNeighbors, isTraverseCompleted)) {
        if (path.length > longestPath.length) {
            longestPath = path;
        }
    }

    return longestPath;
}

export function findAllSameValueAdjacentCells<T>(
    start: Location,
    grid: Grid<T>,
    adjacencyDirections: Direction[] = Direction.allOrthogonal()
) : Path<T> {
    const neighbors = (step: Cell<T>, grid: Grid<T>): Cell<T>[] =>
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
export function* dfsVisitingOnce<T>(
    start: Location,
    grid: Grid<T>,
    getNeighbors: (step: Cell<T>, grid: Grid<T>) => Cell<T>[],
    isTraverseCompleted: (step: Cell<T>, path: Path<T>, neighbors: Cell<T>[]) => boolean = (_, __, neighbors) => neighbors.length === 0
): Generator<Path<T>> {
    return yield* dfs(
        start, grid, getNeighbors, isTraverseCompleted,
        (step, visited) => !visited.has(locationAsString(step.location))
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
export function* dfs<T>(
    start: Location,
    grid: Grid<T>,
    getNeighbors: (step: Cell<T>, grid: Grid<T>) => Cell<T>[],
    isTraverseCompleted: (step: Cell<T>, path: Path<T>, neighbors: Cell<T>[]) => boolean = (_, __, neighbors) => neighbors.length === 0,
    shouldVisit: (step: Cell<T>, visited: Set<string>) => boolean = () => true
): Generator<Path<T>> {
    const visited = new Set<string>();
    visited.add(locationAsString(start));

    const stack = new Stack<Path<T>>();
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
            visited.add(locationAsString(neighbor.location));
            stack.push([...path, neighbor]);
        }
    }
}

function isAlreadyInPath<T>(step: Cell<T>, path: Path<T>) {
    return path.some(next => isEqual(next.location, step.location));
}