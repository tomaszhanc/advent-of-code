import {GuardPosition, nextGuardPositionOnMap} from "../types/GuardPosition";
import {parsePuzzleInput} from "./_parsePuzzleInput";
import {locationToString} from "../../../shared/grid/Location";

export function tilesVisitedByGuard(input: string): number {
    const [guardPosition, map] = parsePuzzleInput(input);
    const visited = new Set<string>();
    let currentGuardPosition : GuardPosition | null = guardPosition;

    while (currentGuardPosition !== null) {
        visited.add(locationToString(currentGuardPosition.location));
        currentGuardPosition = nextGuardPositionOnMap(currentGuardPosition, map);
    }

    return visited.size;
}