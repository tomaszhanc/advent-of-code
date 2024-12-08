import {Location} from "../../../shared/grid/Location";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";

export function* findAntinodes(location: Location, distance: Distance, map: Grid<string>): Generator<Location> {
    location = location.nextBy(distance);

    if (map.hasInBounds(location)) {
        yield location;
    }
}