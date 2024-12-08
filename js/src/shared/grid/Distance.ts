export class Distance {
    constructor(
        public readonly diffX: number,
        public readonly diffY: number
    ) {
    }

    public revert(): Distance {
        return new Distance(-this.diffX, -this.diffY);
    }
}
