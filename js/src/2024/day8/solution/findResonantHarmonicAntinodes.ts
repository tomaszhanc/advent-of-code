import {Location} from "../../../shared/grid/Location";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";

export function* findResonantHarmonicAntinodes(location: Location, distance: Distance, map: Grid<string>): Generator<Location> {
    while (map.hasInBounds(location)) {
        yield location;
        location = location.nextBy(distance);
    }
}