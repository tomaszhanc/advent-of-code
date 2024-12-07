import {GuardPosition} from "../model/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";

export function tilesVisitedByGuard(guardPosition: GuardPosition, map : Grid<string>): number {
    const visited = new Set<string>();
    let currentGuardPosition = guardPosition.nextPosition(map);

    while (currentGuardPosition !== null) {
        visited.add(currentGuardPosition.position.toString());
        currentGuardPosition = currentGuardPosition.nextPosition(map);
    }

    return visited.size
}