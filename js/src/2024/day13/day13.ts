export function part1(input: string): number {
    return Number(numberOfTokens(parsePuzzleInput(input)));
}

export function part2(input: string): number {
    return Number(numberOfTokens(
        parsePuzzleInput(input).map(([buttonA, buttonB, prize]) => {
            const offset = BigInt('10000000000000');

            return [
                buttonA,
                buttonB,
                { x: prize.x + offset, y: prize.y + offset }
            ]}
        )
    ));
}

type Position = {x: bigint, y: bigint};
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
            { x: BigInt(buttonAMatch[1]), y: BigInt(buttonAMatch[2]) },
            { x: BigInt(buttonBMatch[1]), y: BigInt(buttonBMatch[2]) },
            { x: BigInt(prizeMatch[1]),   y: BigInt(prizeMatch[2]) }
        ]
    });
}

function numberOfTokens(machines: Machine[]) : bigint {
    return machines
        .map(([buttonA, buttonB, prize]) => {
            const dividend = prize.x * buttonA.y - prize.y * buttonA.x;
            const divisor  = buttonB.x * buttonA.y - buttonB.y * buttonA.x;

            if (!Number.isInteger(Number(dividend)/Number(divisor))) {
                return BigInt(0);
            }

            const buttonBPresses = dividend/divisor;
            const buttonAPresses = (prize.x - buttonB.x * buttonBPresses) / buttonA.x;

            return buttonAPresses * BigInt(3) + buttonBPresses;
        })
        .reduce((sum: bigint, cost: bigint) => sum + cost, BigInt(0))
    ;
}