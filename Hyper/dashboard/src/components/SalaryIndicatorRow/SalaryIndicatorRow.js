import React from 'react'

function SalaryIndicatorRow({ description, amount }) {
    return (
        <div className="salaryIndicator__row">
            <p>{description}</p>
            <p style={{ width: '75px', justifyContent: 'flex-start', display: 'flex' }}>{amount}</p>
        </div>
    )
}

export default SalaryIndicatorRow
