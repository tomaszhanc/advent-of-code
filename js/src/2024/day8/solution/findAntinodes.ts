import {Location} from "../../../shared/grid/Location";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";

export function* findAntinodes(location: Location, distance: Distance, map: Grid<string>): Generator<Location> {
    location = Location.nextByDistance(location, distance);

    if (map.hasInBounds(location)) {
        yield location;
    }
}