import {isEqual, Location, locationAsString} from "../Location";
import {lastItem} from "../../utils/collection.utils";
import {Cell, Grid} from "../Grid";
import {Queue} from "../../struct/Queue";

export type Path<T> = Cell<T>[];

export function findShortestPath<T>(
    start: Location,
    grid: Grid<T>,
    getNeighbors: (step: Cell<T>, grid: Grid<T>) => Cell<T>[],
    isTraverseCompleted: (step: Cell<T>, path: Path<T>, neighbors: Cell<T>[]) => boolean = (_, __, neighbors) => neighbors.length === 0
) : Path<T> {
    let shortestPath : Path<T> | null = null;

    for (let path of bfs(start, grid, getNeighbors, isTraverseCompleted)) {
        if (shortestPath === null || path.length < shortestPath.length) {
            shortestPath = path;
        }
    }

    return shortestPath ?? [];
}

export function* bfs<T>(
    start: Location,
    grid: Grid<T>,
    getNeighbors: (step: Cell<T>, grid: Grid<T>) => Cell<T>[],
    isTraverseCompleted: (step: Cell<T>, path: Path<T>, neighbors: Cell<T>[]) => boolean = (_, __, neighbors) => neighbors.length === 0,
    shouldVisit: (step: Cell<T>, visited: Set<string>) => boolean = (step, visited) => !visited.has(locationAsString(step.location))
): Generator<Path<T>> {
    const visited = new Set<string>();
    visited.add(locationAsString(start));

    const queue = new Queue<Path<T>>();
    queue.enqueue([grid.cellAt(start)]);

    while (!queue.isEmpty()) {
        const path = queue.dequeue();
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
            queue.enqueue([...path, neighbor]);
        }
    }
}

function isAlreadyInPath<T>(step: Cell<T>, path: Path<T>) {
    return path.some(next => isEqual(next.location, step.location));
}