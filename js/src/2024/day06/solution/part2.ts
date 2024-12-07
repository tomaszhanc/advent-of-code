import {GuardPosition} from "../model/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";
import {Location} from "../../../shared/grid/Location";

export function obstaclesToLoopTheGuard(guardPosition: GuardPosition, map : Grid<string>): number {
    let obstacles = 0;

    for (let y = 0; y < map.height; y++) {
        for (let x = 0; x < map.width; x++) {
            let modifiedMap = plantObstacle(new Location(x, y), map);
            let currentGuardPosition = guardPosition.nextMove(modifiedMap);
            const visited = new Set<string>();

            while (currentGuardPosition !== null) {
                if (isGuardStackedInTheLoop(visited, currentGuardPosition)) {
                    obstacles++;
                    break;
                }

                visited.add(currentGuardPosition.toString());
                currentGuardPosition = currentGuardPosition.nextMove(modifiedMap);
            }
        }
    }

    return obstacles;
}

const plantObstacle = (location: Location, map: Grid<string>) => map.setValue('#', location);
const isGuardStackedInTheLoop = (visited: Set<string>, currentGuardPosition: GuardPosition) => visited.has(currentGuardPosition.toString());
