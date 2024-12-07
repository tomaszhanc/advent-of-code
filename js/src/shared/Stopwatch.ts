export class Stopwatch {
    private measurements: Map<string, { start: number, stop?: number }> = new Map();

    public start(name: string): void {
        this.measurements.set(name, { start: performance.now() });
    }

    public stop(name: string): void {
        const measurement = this.measurements.get(name);

        if (!measurement) {
            throw new Error(`No measurement found for ${name}`);
        }

        measurement.stop = performance.now()
    }

    public result(name: string): number {
        const measurement = this.measurements.get(name);

        if (!measurement || !measurement.stop) {
            throw new Error(`No completed measurement found for ${name}`);
        }

        return measurement.stop - measurement.start;
    }
}
