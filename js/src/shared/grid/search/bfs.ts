import {equals, Location, locationToString} from "../Position.js";
import {lastItem} from "../../utils/collection.utils.js";
import {Cell, Grid} from "../Grid.js";
import {Queue} from "../../struct/Queue.js";

export type Path = Cell[];

export function findShortestPath(
    start: Location,
    grid: Grid,
    getNeighbors: (step: Cell, grid: Grid) => Cell[],
    isTraverseCompleted: (step: Cell, path: Path, neighbors: Cell[]) => boolean = (_, __, neighbors) => neighbors.length === 0
) : Path {
    let shortestPath : Path | null = null;

    for (let path of bfs(start, grid, getNeighbors, isTraverseCompleted)) {
        if (shortestPath === null || path.length < shortestPath.length) {
            shortestPath = path;
        }
    }

    return shortestPath ?? [];
}

export function* bfs(
    start: Location,
    grid: Grid,
    getNeighbors: (step: Cell, grid: Grid) => Cell[],
    isTraverseCompleted: (step: Cell, path: Path, neighbors: Cell[]) => boolean = (_, __, neighbors) => neighbors.length === 0,
    shouldVisit: (step: Cell, visited: Set<string>) => boolean = (step, visited) => !visited.has(locationToString(step.location))
): Generator<Path> {
    const visited = new Set<string>();
    visited.add(locationToString(start));

    const queue = new Queue<Path>();
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
            visited.add(locationToString(neighbor.location));
            queue.enqueue([...path, neighbor]);
        }
    }
}

function isAlreadyInPath(step: Cell, path: Path) {
    return path.some(next => equals(next.location, step.location));
}