export type Equation = {
    testValue: number;
    numbers: number[];
}

export const Equation = {
    create(testValue: number, numbers: number[]): Equation {
        return {testValue, numbers};
    },

    isValid(equation: Equation, operators: string[]): boolean {
        let total = equation.numbers[0];

        for (let i = 1; i < equation.numbers.length; i++) {
            switch (operators[i]) {
                case '+':
                    total += equation.numbers[i];
                    break;
                case '*':
                    total *= equation.numbers[i];
                    break;
                case '||':
                    total = parseInt(total.toString() + equation.numbers[i].toString());
                    break;
            }
        }

        return total === equation.testValue;
    }
}