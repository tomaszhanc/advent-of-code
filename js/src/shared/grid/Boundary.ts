import {Location} from "./Location";

export function insideBoundary(location: Location, boundary: Location[]) {
    const yLocations : Location[] = [];

    for (let boundaryLocation of boundary) {
        if (location.y === boundaryLocation.y) {
            yLocations.push(boundaryLocation);
        }
    }

    const xMin = Math.min(...yLocations.map(location => location.x));
    const xMaX = Math.max(...yLocations.map(location => location.x));

    return location.x >= xMin && location.x <= xMaX;
}