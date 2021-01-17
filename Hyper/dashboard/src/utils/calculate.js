export const calculateTotalDays = (salary) => {
    let total = 0

    if (Object.entries(salary).length !== 0 && salary.constructor === Object) {
        salary.salary_days.forEach(day => {
            total += calculateTotalDay(day, (row) => row)
        });
    }

    return total;
}

export const calculateTotalDaysManual = (salary) => {
    let total = 0
    if (Object.entries(salary).length !== 0 && salary.constructor === Object) {
        const manual = Object.keys(salary.salary_manual).map(key => salary.salary_manual[key])
        manual.forEach(day => {
            return total += day.price
        })
        return total;
    }
}

export const calculateTotalSalary = (salary) => {
    return calculateTotalDays(salary) + calculateTotalDaysManual(salary);
}

export const calculateTotalBonusDay = (salaryDay) => {
    return calculateTotalDay(salaryDay, ((row) => row.is_bonus));
}

export const calculateTotalAmountDay = (salaryDay) => {
    return calculateTotalDay(salaryDay, ((row) => !row.is_bonus));
}

export const calculateTotalDay = (salaryDay, filter) => {
    let total = 0;

    salaryDay.rows.filter(filter).map((filteredRow) => {
        return filteredRow.price * filteredRow.amount
    }).forEach(price => total += price);

    return total;
}


