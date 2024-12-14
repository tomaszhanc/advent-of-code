import {parsePuzzleInput} from "./_parsePuzzleInput";
import {nextInDirections} from "../../../shared/grid/Location";
import {Grid} from "../../../shared/grid/Grid";
import {Direction} from "../../../shared/grid/Direction";
import {
    forNeighbours,
    Step,
    stopWhen,
    traverseAllFrom,
    traverseAllOnceFrom
} from "../../../shared/grid/search/deepFirstSearch";

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

function getTrailheadScore(trailhead: Step<number>, topographicMap: Grid<number>): number {
    return Array.from(
        traverseAllOnceFrom(trailhead, forNeighbours(topographicMap, allNeighbours), stopWhen(reachedThePeak))
    ).length;
}

function getTrailheadRating(trailhead: Step<number>, topographicMap: Grid<number>): number {
    return Array.from(
        traverseAllFrom(trailhead, forNeighbours(topographicMap, allNeighbours), stopWhen(reachedThePeak))
    ).length;
}

function findAllTrailHeads(topographicMap: Grid<number>): Step<number>[] {
    return topographicMap
        .allLocationsOf(0)
        .map((location) => ({ location, value: 0 }));
}

function allNeighbours(step: Step<number>, topographicMap: Grid<number>): Step<number>[] {
    return nextInDirections(step.location, Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT)
        .filter(location => topographicMap.hasInBounds(location))
        .filter(location => topographicMap.valueAt(location)! - step.value === 1)
        .map(location => ({location: location, value: topographicMap.valueAt(location)!}));
}

const reachedThePeak = (step: Step<number>) : boolean => step.value === 9;
