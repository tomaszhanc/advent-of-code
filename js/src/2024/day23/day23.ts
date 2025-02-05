import {readByLine} from "../../shared/read.input.js";
import {Stack} from "../../shared/struct/Stack.js";
import {last} from "../../shared/utils/collection.utils.js";

export function part1(input: string): number {
    return findAllSetsOfThrees(createNetwork(parsePuzzleInput(input))).size;
}

export function part2(input: string): string {
    return getLanPartyPassword(findLanParty(parsePuzzleInput(input)));
}

function parsePuzzleInput(input: string) : Set<string> {
    return new Set(readByLine(input).map(line => line.split('-').sort().join('-')));
}

function createNetwork(connections: Set<string>) : Map<string, Set<string>> {
    const network = new Map<string, Set<string>>();

    for (const connection of connections) {
        const [computerA, computerB] = connection.split('-');
        network.set(computerA, (network.get(computerA) ?? new Set<string>).add(computerB));
        network.set(computerB, (network.get(computerB) ?? new Set<string>).add(computerA));
    }

    return network;
}

function findAllSetsOfThrees(network: Map<string, Set<string>>) : Set<string> {
    const setsOfThrees = new Set<string>;

    for (const [computerA, connectionsA] of network) {
        for (const computerB of connectionsA.values()) {
            const connectionsB = network.get(computerB)!;
            const mutualConnections = connectionsA.intersection(connectionsB);

            for (const computerC of mutualConnections) {
                if (computerA.startsWith('t') || computerB.startsWith('t') || computerC.startsWith('t')) {
                    setsOfThrees.add([computerA, computerB, computerC].sort().join('-'));
                }
            }
        }
    }

    return setsOfThrees;
}

function findLanParty(connections: Set<string>) : string[] {
    const network = createNetwork(connections);
    const visited = new Set<string>();

    let max : string[] = [];

    for (const computer of network.keys()) {
        const stack = new Stack<string[]>();
        stack.push([computer]);

        while (!stack.isEmpty()) {
            const currentLan = stack.pop();
            const lastComputer = last(currentLan);

            if (currentLan.length > max.length) {
                max = currentLan;
            }

            for (const next of network.get(lastComputer)!) {
                const newLan = [...currentLan, next];
                if (visited.has(asConnection(newLan)) || currentLan.includes(next)) {
                    continue;
                }

                visited.add(asConnection(newLan));

                if (isConnectedTo(next, currentLan, connections)) {
                    stack.push(newLan);
                }
            }
        }
    }

    return max;
}

function isConnectedTo(computer: string, lan: string[], connections: Set<string>) : boolean {
    for (const next of lan) {
        if (!connections.has(asConnection([computer, next]))) {
            return false;
        }
    }

    return true;
}

const getLanPartyPassword = (computers: string[]) : string => computers.sort().join(',');
const asConnection = (computers: string[]) : string => computers.sort().join('-');