import {GuardPosition} from "../model/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";

export function tilesVisitedByGuard(guardPosition: GuardPosition, map : Grid<string>): number {
    const visited = new Set<string>();
    let currentGuardPosition : GuardPosition | null = guardPosition;

    while (currentGuardPosition !== null) {
        visited.add(currentGuardPosition.position.toString());
        currentGuardPosition = currentGuardPosition.nextMove(map);
    }

    return visited.size
}