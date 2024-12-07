import {GuardPosition} from "../model/GuardPosition";
import {Input} from "../../../shared/Input";
import {parsePuzzleInput} from "./parsePuzzleInput";

export function tilesVisitedByGuard(input: Input): number {
    const [guardPosition, map] = parsePuzzleInput(input);

    const visited = new Set<string>();
    let currentGuardPosition : GuardPosition | null = guardPosition;

    while (currentGuardPosition !== null) {
        visited.add(currentGuardPosition.position.toString());
        currentGuardPosition = currentGuardPosition.nextMove(map);
    }

    return visited.size;
}