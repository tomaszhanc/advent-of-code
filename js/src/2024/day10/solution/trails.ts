import {parsePuzzleInput} from "./_parsePuzzleInput";
import {Grid} from "../../../shared/grid/Grid";
import {Stack} from "../../../shared/struct/Stack";
import {Location, locationAsString, nextInDirections} from "../../../shared/grid/Location";
import {Direction} from "../../../shared/grid/Direction";
import {lastItem} from "../../../shared/utils/collection.utils";

type Step = {
    readonly location: Location,
    readonly height: number
};

type Path = Step[];

export function sumScoreOfAllTrailheads(input: string): number {
    const topographicMap = parsePuzzleInput(input);

    return findAllTrailHeads(topographicMap)
        .reduce((sum, trailhead) => sum + getTrailheadScore(trailhead, topographicMap), 0);
}

export function sumRanksOfAllTrailheads(input: string): number {
    const topographicMap = parsePuzzleInput(input);

    return findAllTrailHeads(topographicMap)
        .reduce((sum, trailhead) => sum + getTrailheadRating(trailhead, topographicMap), 0);
}

function getTrailheadScore(trailhead: Step, topographicMap: Grid<number>) : number {
    return countTrailheadPaths(trailhead, topographicMap, (completedPath: Path) => locationAsString(lastItem(completedPath).location));
}

function getTrailheadRating(trailhead: Step, topographicMap: Grid<number>) : number {
    return countTrailheadPaths(trailhead, topographicMap, (completedPath: Path) => completedPath);
}

function countTrailheadPaths<T>(start: Step, topographicMap: Grid<number>, resultItemFor: (completedPath: Path) => T ) {
    let results = new Set<T>();

    const stack = new Stack<Path>();
    stack.push([start]);

    while (!stack.isEmpty()) {
        const currentPath = stack.pop();
        const currentStep = lastItem(currentPath);

        if (reachedThePeak(currentStep)) {
            results.add(resultItemFor(currentPath));
            continue;
        }

        for (const nextStep of allNextSteps(currentStep, topographicMap)) {
            if (stepAlreadyVisited(nextStep, currentPath)) {
                continue;
            }

            const newPath = [...currentPath, nextStep];
            stack.push(newPath)
        }
    }

    return results.size;
}

function findAllTrailHeads(topographicMap: Grid<number>) : Step[] {
    return Array.from(topographicMap.cells)
        .filter(([location, height]) => height === 0)
        .map(([location, height]) => ({location: Location.fromString(location), height: height}));
}

function allNextSteps(step: Step, topographicMap: Grid<number>) : Step[] {
    return nextInDirections(step.location, Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT)
        .filter(location => topographicMap.hasInBounds(location))
        .filter(location => topographicMap.valueOf(location)! - step.height === 1)
        .map(location => ({location: location, height: topographicMap.valueOf(location)!}));
}

const reachedThePeak = (step: Step) : boolean => step.height === 9;
const stepAlreadyVisited = (step: Step, path: Step[]) => path.some(other => step.location === other.location);
