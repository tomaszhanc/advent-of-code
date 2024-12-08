export function combinations<T>(values: Iterable<T>, length: number): T[][] {
    if (length === 0) {
        return [[]];
    }

    const combos = combinations(values, length - 1);

    return Array.from(values).flatMap(
        allowedValue => combos.map(combo => [...combo, allowedValue])
    );
}