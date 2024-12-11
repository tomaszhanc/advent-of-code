export type Distance = {
    readonly dX: number,
    readonly dY: number
}

export function invert(distance: Distance): Distance {
    return { dX: -distance.dX, dY: -distance.dY };
}