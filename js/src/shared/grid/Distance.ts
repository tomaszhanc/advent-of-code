export type Distance = {
    readonly diffX: number,
    readonly diffY: number
}

export const Distance = {
    create: (diffX: number, diffY: number): Distance => ({diffX, diffY}),

    revert: (distance: Distance): Distance => Distance.create(-distance.diffX, -distance.diffY)
}