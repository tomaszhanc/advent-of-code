import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);

export function readPuzzleInput(relativePath: string): string {
    const filePath = path.resolve(path.dirname(__filename), `../../../resources/${relativePath}`);
    return fs.readFileSync(filePath, 'utf-8').trim();
}

export function readByLine(data: string) : string[] {
    return data.trim().split('\n');
}