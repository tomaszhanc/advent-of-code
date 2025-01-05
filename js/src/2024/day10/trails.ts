import {Location} from "../../shared/grid/Position.js";
import {Grid, Cell} from "../../shared/grid/Grid.js";
import {Direction} from "../../shared/grid/Direction.js";
import {dfs, dfsVisitingOnce} from "../../shared/grid/search/dfs.js";

export function sumScoreOfAllTrailheads(input: string): number {
    const topographicMap = Grid.fromString(input);

    return getAllTrailHeads(topographicMap)
        .map(trailhead => getTrailheadScore(trailhead, topographicMap))
        .reduce((sum, score) => sum + score, 0);
}

export function sumRanksOfAllTrailheads(input: string): number {
    const topographicMap = Grid.fromString(input);

    return getAllTrailHeads(topographicMap)
        .map(trailhead => getTrailheadRating(trailhead, topographicMap))
        .reduce((sum, rating) => sum + rating, 0);
}

function getAllTrailHeads(topographicMap: Grid): Location[] {
    return topographicMap.allLocationsOf('0');
}

function getTrailheadScore(trailhead: Location, topographicMap: Grid): number {
    return Array.from(
        dfsVisitingOnce(trailhead, topographicMap, neighbours, reachedThePeak)
    ).length;
}

function getTrailheadRating(trailhead: Location, topographicMap: Grid): number {
    return Array.from(
        dfs(trailhead, topographicMap, neighbours, reachedThePeak)
    ).length;
}

function neighbours(step: Cell, topographicMap: Grid): Cell[] {
    return topographicMap
        .nextInDirections(step.location, [Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT])
        .filter(cell => +cell.value! - +step.value! === 1);
}

const reachedThePeak = (step: Cell) : boolean => +step.value! === 9;