export function compactMemoryByBlock(memory: string[]): string[] {
    let compactedMemory = Array.from(memory);

    for (let freeBlockIdx of freeBlocksToCompact(compactedMemory)) {
        let lastFileBlockIdx = lastFileBlockIndex(compactedMemory);

        // Stop compacting
        if (freeBlockIdx > lastFileBlockIdx) {
            break;
        }

        // Move last file block to an earlier position in memory
        compactedMemory[freeBlockIdx] = memory[lastFileBlockIdx];
        compactedMemory[lastFileBlockIdx] = '.';
    }

    return compactedMemory;
}

function freeBlocksToCompact(memory: string[]) : number[] {
    const freeBlocksToCompact : number[] = [];

    for (let i = lastFileBlockIndex(memory); i >= 0; i--) {
        if (memory[i] === '.') {
            freeBlocksToCompact.push(i);
        }
    }

    return freeBlocksToCompact.reverse();
}

function lastFileBlockIndex(memory: string[]): number {
    for (let i = memory.length - 1; i >= 0; i--) {
        if (memory[i] !== '.') {
            return i;
        }
    }

    return -1;
}