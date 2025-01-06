export function splitEvenDigitNumber(number: number): [number, number] {
    const numberString = number.toString(10);

    if (numberString.length % 2 !== 0) {
        throw new Error("Number must have an even number of digits");
    }

    const midpoint = numberString.length / 2;

    return [+numberString.substring(0, midpoint), +numberString.substring(midpoint)];
}

/**
 * Mathematical implementation for the modulo operation instead of truncated division used by the % operator.
 * Example: -2 % 7 = -2, but modulo(-2, 7) = 5
 */
export function modulo(dividend: number, divisor: number): number {
    return (dividend % divisor + divisor) % divisor;
}

export function lowestCommonMultiple(...numbers: number[]): number {
    if (numbers.length === 0) {
        return 0;
    }

    let a = numbers.shift() as number;
    for (const b of numbers) {
        a = Math.abs(a * b) / greatestCommonDivisor(a, b);
    }

    return a;
}

export function asKey(...parts: string[]): string {
    return parts.join('_');
}

function greatestCommonDivisor(a: number, b: number): number {
  let gcd = a;

  while (b !== 0) {
    const remainder = gcd % b;
    gcd = b;
    b = remainder;
  }

  return gcd;
}
