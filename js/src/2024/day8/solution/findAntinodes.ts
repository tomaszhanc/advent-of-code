import {Location, nextByDistance} from "../../../shared/grid/Location";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";

export function* findAntinodes(location: Location, distance: Distance, map: Grid<string>): Generator<Location> {
    location = nextByDistance(location, distance);

    if (map.hasInBounds(location)) {
        yield location;
    }
}