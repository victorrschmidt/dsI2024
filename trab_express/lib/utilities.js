const departments = {
    1: 'Administrativo',
    2: 'Designer',
    3: 'Contábil',
    4: 'Fábrica'
};

function liquidSalaryCalculator(salary) {
    const ranges = [69.20, 138.66, 205.56];
    const INSS = salary * 0.11;
    let IRPF;

    if (salary > 4664.68) {
        IRPF = (salary - 4664.68) * 0.275 + 413.42;
    }
    else if (salary > 3751.06) {
        IRPF = (salary - 3751.06) * 0.225 + 207.86;
    }
    else if (salary > 2826.65) {
        IRPF = (salary - 2826.65) * 0.150 + 69.20;
    }
    else if (salary > 1903.98) {
        IRPF = (salary - 1903.98) * 0.075; 
    }
    else {
        IRPF = 0.00;
    }

    const LIQUID_SALARY = salary - INSS - IRPF;

    return LIQUID_SALARY.toFixed(2);
}

function currencyFormat(value) {
    return new Intl.NumberFormat('de-DE', { minimumFractionDigits: 2 }).format(value);
}

module.exports = {
    departments,
    liquidSalaryCalculator,
    currencyFormat
};