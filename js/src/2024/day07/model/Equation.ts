export class Equation {
    constructor(
        public readonly testValue: number,
        public readonly numbers: number[]
    ) {}

    public isValid(operators: string[]) : boolean {
        let total = this.numbers[0];

        for (let i = 1; i < this.numbers.length; i++) {
            if (operators[i] === '+') {
                total += this.numbers[i];
            } else {
                total *= this.numbers[i];
            }
        }

        return total === this.testValue;
    }
}
