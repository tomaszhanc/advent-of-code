import fs from 'fs';
import path from 'path';

export class Input {
    constructor (
        private readonly data: string
    ) {}

    lines(): string[] {
        return this.data.split('\n');
    }

    content(): string {
        return this.data;
    }
}

export const readPuzzleInput = (year: number, day: number): Input => {
    const filePath = path.resolve(__dirname, `../../../resources/${year}/day${day.toString()}.txt`);

    return new Input(fs.readFileSync(filePath, 'utf-8').trim());
};
