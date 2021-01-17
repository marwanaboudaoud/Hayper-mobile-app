export const calculateTotalRows = (data) => {
    let total = 0;
    data.forEach(salary => {
        salary.rows.forEach(row => {
            const rowtotal = (row.amount * row.price);
            return total += rowtotal
        })
    })
    return total.toFixed(2);
}

export const calculateTotalRowsDifference = (p, n) => {
    let positive = calculateTotalRows(p);
    let negative = calculateTotalRows(n)
    return (parseFloat(positive) + parseFloat(negative)).toFixed(2)
}


export const calculateTotalMonth = (data) => {
    let total = 0;
    data.forEach(shift => {
        shift.salary_days.forEach(day => {
            day.rows.forEach(row => {
                total += (row.price * row.amount)
            })
        })
    })

    return total.toFixed(2)
}

export const calculateTotalDays = (data) => {
    let total = 0
    data.forEach(salary => {
        salary.salary_days.forEach(day => {
            day.rows.forEach(row => {
                const rowPrice = (row.amount * row.price)
                return total += rowPrice
            })
        })
    })
    return total.toFixed(2)
}



export const totalDaysWorked = array => {
    let days = new Set();
    array.forEach(day => day.salary_days.forEach(day => {
        days.add(day.date)
    }
    ))

    return [...days].length
}

export const totalDescriptions = array => {
    let descriptions = new Set();
    array.forEach(day => day.salary_days.forEach(day =>
        day.rows.forEach(row => {
            if (!descriptions.has(row)) {
                descriptions.add({ name: row.description, total: (row.price * row.amount).toFixed(2) })
            }
        })
    ))
    return [...descriptions]
}
