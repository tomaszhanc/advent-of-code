import fs from 'fs';
import path from 'path';

export function readPuzzleInput(relativePath: string): string {
    const filePath = path.resolve(__dirname, `../../../resources/${relativePath}`);
    return fs.readFileSync(filePath, 'utf-8').trim();
}

export function readByLine(data: string) : string[] {
    return data.trim().split('\n');
}