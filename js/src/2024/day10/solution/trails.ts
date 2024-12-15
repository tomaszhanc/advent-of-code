import {parsePuzzleInput} from "./_parsePuzzleInput";
import {Location} from "../../../shared/grid/Location";
import {Grid, Cell} from "../../../shared/grid/Grid";
import {Direction} from "../../../shared/grid/Direction";
import {findAllPaths, findAllPathsVisitingOnceFrom} from "../../../shared/grid/search/dfs";

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

function getTrailheadScore(trailhead: Location, topographicMap: Grid<number>): number {
    return Array.from(
        findAllPathsVisitingOnceFrom(trailhead, topographicMap, neighbours, reachedThePeak)
    ).length;
}

function getTrailheadRating(trailhead: Location, topographicMap: Grid<number>): number {
    return Array.from(
        findAllPaths(trailhead, topographicMap, neighbours, reachedThePeak)
    ).length;
}

function findAllTrailHeads(topographicMap: Grid<number>): Location[] {
    return topographicMap.allLocationsOf(0);
}

function neighbours(step: Cell<number>, topographicMap: Grid<number>): Cell<number>[] {
    return topographicMap
        .nextInDirections(step.location, [Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT])
        .filter(cell => cell.value - step.value === 1);
}

const reachedThePeak = (step: Cell<number>) : boolean => step.value === 9;
