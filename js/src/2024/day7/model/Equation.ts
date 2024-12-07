export class Equation {
    constructor(
        public readonly testValue: number,
        public readonly numbers: number[]
    ) {}

    public isValid(operators: string[]) : boolean {
        let total = this.numbers[0];

        for (let i = 1; i < this.numbers.length; i++) {
            switch (operators[i]) {
                case '+':
                    total += this.numbers[i];
                    break;
                case '*':
                    total *= this.numbers[i];
                    break;
                case '||':
                    total = parseInt(total.toString() + this.numbers[i].toString());
                    break;
            }
        }

        return total === this.testValue;
    }
}
