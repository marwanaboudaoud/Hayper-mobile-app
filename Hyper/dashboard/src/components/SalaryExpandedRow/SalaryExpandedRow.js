import React from 'react'
import { toDutchValue } from '../../utils/helpers';

function SalaryExpandedRow({ expandedDetails }) {
    let { description, underline_description, amount, price } = expandedDetails;

    const total_price = amount * price;
    return (
        <div className="salary__details--bottom-info">
            <p>{description}</p>
            <p>{underline_description}</p>
            <p>{amount}</p>
            <p>{toDutchValue(price)}</p>
            <p className={total_price.toString().includes('-') ? 'negative' : null}>{toDutchValue(total_price)}</p>
        </div>
    )
}

export default SalaryExpandedRow
