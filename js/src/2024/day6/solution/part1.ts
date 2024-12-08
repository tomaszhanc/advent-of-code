import {GuardPosition} from "../model/GuardPosition";
import {GuardMovement} from "../model/GuardMovement";
import {parsePuzzleInput} from "./parsePuzzleInput";
import {Location} from "../../../shared/grid/Location";

export function tilesVisitedByGuard(input: string): number {
    const [guardPosition, map] = parsePuzzleInput(input);
    const visited = new Set<string>();
    let currentGuardPosition : GuardPosition | null = guardPosition;

    while (currentGuardPosition !== null) {
        visited.add(Location.asString(currentGuardPosition.location));
        currentGuardPosition = GuardMovement.nextMove(currentGuardPosition, map);
    }

    return visited.size;
}