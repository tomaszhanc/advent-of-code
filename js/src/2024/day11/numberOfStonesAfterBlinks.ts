import {splitEvenDigitNumber} from "../../shared/utils/uncommon";

type Stone = number;

export function numberOfStonesAfterBlinks(blinks: number, input: string): number {
    let stones : Map<Stone, number> = new Map(input.split(' ').map(Number).map(stone => [stone, 1]));

    for (let i = 0; i < blinks; i++) {
        let newStones = new Map();

        for (let [stone, numberOfStones] of stones.entries()) {
            for (let newStone of blink(stone)) {
                newStones.set(newStone, numberOfStones + (newStones?.get(newStone) ?? 0));
            }
        }

        stones = newStones;
    }

    return Array.from(stones.values()).reduce((sum, numberOfStones) => sum + numberOfStones, 0);
}

function blink(stone: Stone): Stone[] {
    let rule : (stone: Stone) => Stone[];

    switch (true) {
        case stone === 0:
            rule = () => [1];
            break;

        case hasEvenDigits(stone):
            rule = () => splitEvenDigitNumber(stone);
            break;

        default:
            rule = () => [stone * 2024];
    }

    return rule(stone);
}

const hasEvenDigits = (stone: Stone) => stone.toString(10).length % 2 === 0;
