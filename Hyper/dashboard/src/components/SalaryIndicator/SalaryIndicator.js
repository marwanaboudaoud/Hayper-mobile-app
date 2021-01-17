import React from 'react'
import './SalaryIndicator.styles.scss'
import SalaryIndicatorRow from '../SalaryIndicatorRow/SalaryIndicatorRow'
import { min } from 'moment'
import { toDutchValue } from '../../utils/helpers';

function SalaryIndicator({ scores, custom }) {
    const total = (parseFloat(scores) + parseFloat(custom));
    return (
        <div className="salaryIndicator no-padding">
            {scores ? <SalaryIndicatorRow description={'Subtotaal bedrag vanuit scores'} amount={toDutchValue(scores)} /> : null}
            {custom ? <SalaryIndicatorRow description={'Subtotaal bedrag vanuit handmatig ingevoerde gegevens'} amount={toDutchValue(custom)} /> : null}
            <div className="salaryIndicator__subtotal">
                <p>Totaal bedrag : <span className="salaryIndicator__subtotal--amount">{toDutchValue(total)}</span></p>
            </div>
        </div>
    )
}

export default SalaryIndicator
