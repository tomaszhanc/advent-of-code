import {guardPositionAsString, GuardPosition, nextGuardPositionOnMap} from "../types/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";
import {Location} from "../../../shared/grid/Location";
import {parsePuzzleInput} from "./_parsePuzzleInput";

export function obstaclesToLoopTheGuard(input: string): number {
    const [guardPosition, map] = parsePuzzleInput(input);
    let obstacles = 0;

    for (let y = 0; y < map.height; y++) {
        for (let x = 0; x < map.width; x++) {
            let modifiedMap = plantObstacle({ x, y}, map);
            let currentGuardPosition = nextGuardPositionOnMap(guardPosition, modifiedMap);
            const visited = new Set<string>();

            while (currentGuardPosition !== null) {
                if (isGuardStackedInTheLoop(currentGuardPosition, visited)) {
                    obstacles++;
                    break;
                }

                visited.add(guardPositionAsString(currentGuardPosition));
                currentGuardPosition = nextGuardPositionOnMap(currentGuardPosition, modifiedMap);
            }
        }
    }

    return obstacles;
}

const plantObstacle = (location: Location, map: Grid<string>) => map.setValue('#', location);
const isGuardStackedInTheLoop = (guardPosition: GuardPosition, visited: Set<string>) => visited.has(guardPositionAsString(guardPosition));