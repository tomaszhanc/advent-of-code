export function part1(input: string): number {
    return numberOfTokens(parsePuzzleInput(input));
}

export function part2(input: string): number {
    return numberOfTokens(parsePuzzleInput(input), 10_000_000_000_000);
}

type Position = {x: number, y: number};
type Machine = [Position, Position, Position];

function parsePuzzleInput(input: string) : Machine[] {
    return input.trim().split('\n\n').map(machine => {
        const lines = machine.split('\n');
        const buttonAMatch = lines[0].match(/Button A: X\+(\d+), Y\+(\d+)/);
        const buttonBMatch = lines[1].match(/Button B: X\+(\d+), Y\+(\d+)/);
        const prizeMatch = lines[2].match(/Prize: X=(\d+), Y=(\d+)/);

        if (!buttonAMatch || !buttonBMatch || !prizeMatch) {
            throw new Error(`Cannot parse machine: ${machine}`);
        }

        return [
            { x: +buttonAMatch[1], y: +buttonAMatch[2] },
            { x: +buttonBMatch[1], y: +buttonBMatch[2] },
            { x: +prizeMatch[1],   y: +prizeMatch[2] }
        ]
    });
}

function numberOfTokens(machines: Machine[], prizeOffset: number = 0) : number {
    return machines
        .map(([buttonA, buttonB, prize]) => {
            prize.x += prizeOffset;
            prize.y += prizeOffset;

            const b = (prize.x * buttonA.y - prize.y * buttonA.x) / (buttonB.x * buttonA.y - buttonB.y * buttonA.x);
            const a = (prize.x - buttonB.x * b) / buttonA.x;

            return [a, b];
        })
        .filter(([a, b]) => Number.isInteger(a) && Number.isInteger(b))
        .map(([a, b]) => a * 3 + b)
        .reduce((sum: number, cost: number) => sum + cost, 0)
}