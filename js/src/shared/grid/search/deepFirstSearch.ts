import {Stack} from "../../struct/Stack";
import {isEqual, Location, locationAsString} from "../Location";
import {lastItem} from "../../utils/collection.utils";
import {Grid, GridType} from "../Grid";

export type Step<T> = {
    readonly location: Location,
    readonly value: T
};

export type Path<T> = Step<T>[];

/**
 * Traverse all available paths, avoiding cycles and visiting each step only once.
 *
 * By default, it traverses until all neighbors are visited. You can pass a custom `isTraverseCompleted`
 * function to stop the traversal at a specific step.
 */
export function* traverseAllOnceFrom<T extends string | number>(
    start: Step<T>,
    getNeighbors: (step: Step<T>) => Step<T>[],
    isTraverseCompleted: (step: Step<T>, path: Path<T>) => boolean = () => false
): Generator<Path<T>> {
    return yield* traverseAllFrom(
        start, getNeighbors, isTraverseCompleted,
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
export function* traverseAllFrom<T extends string | number>(
    start: Step<T>,
    getNeighbors: (step: Step<T>) => Step<T>[],
    isTraverseCompleted: (step: Step<T>, path: Path<T>) => boolean = () => false,
    shouldTraverse: (step: Step<T>, visited: Set<string>) => boolean = () => true
): Generator<Path<T>> {
    const visited = new Set<string>();
    const stack = new Stack<Path<T>>();
    stack.push([start]);

    while (!stack.isEmpty()) {
        const currentPath = stack.pop();
        const currentStep = lastItem(currentPath);

        if (isTraverseCompleted(currentStep, currentPath)) {
            yield currentPath;
        }

        for (const neighbor of getNeighbors(currentStep)) {
            if (!shouldTraverse(neighbor, visited)) {
                continue;
            }

            if (isAlreadyInPath(neighbor, currentPath)) {
                continue;
            }

            visited.add(locationAsString(neighbor.location));
            stack.push([...currentPath, neighbor]);
        }
    }
}

export function forNeighbours<T extends GridType>(
    topographicMap: Grid<T>,
    getNeighbours: (step: Step<T>, topographicMap: Grid<T>) => Step<T>[]
) {
    return (step: Step<T>): Step<T>[] => getNeighbours(step, topographicMap);
}

export function stopWhen<T>(isTraverseCompleted: (step: Step<T>, path: Path<T>) => boolean) {
    return (step: Step<T>, path: Path<T>) => isTraverseCompleted(step, path);
}

function isAlreadyInPath<T>(step: Step<T>, path: Path<T>) {
    return path.some(next => isEqual(next.location, step.location));
}