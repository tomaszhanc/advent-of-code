export function generateAllCombinations<T extends string | number>(length: number, allowedValues: T[]): T[][] {
    if (length === 0) {
        return [[]];
    }

    const combinations = generateAllCombinations(length - 1, allowedValues);

    return allowedValues.flatMap(
        allowedValue => combinations.map(combination => [...combination, allowedValue])
    );
}