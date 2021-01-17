import React, { useState } from 'react'
import './Salary.styles.scss'
import DropdownArrow from '../../assets/img/icons/dropdown-arrow.svg'
import SalaryExpandDetails from '../../components/SalaryExpandDetails/SalaryExpandDetails'
import {toDutchValue} from '../../utils/helpers'
function Salary({ date, opdrachtgever, gereden, bedrag, bonus, totaalBedrag, expandedDetails }) {
    const [isVisible, setToggled] = useState(false);

    const toggleTrueFalse = (event) => {
        event.preventDefault();
        setToggled(!isVisible);
    }

    let isExpandable = false;
    if (Object.entries(expandedDetails).length === 0 && expandedDetails.constructor === Object) {
        isExpandable = false;
    } else {
        isExpandable = true;
    }

    let amount = 0;
    if (expandedDetails.length > 0) {
        for (let i = 0; i < expandedDetails.length; i++) {
            amount = amount + expandedDetails[i].amount;
        }
    }
    return (
        <div className="salary">
            <div className="salary__top">
                <p>{date}</p>
                <p>{opdrachtgever}</p>
                <p><span className={gereden ? "gereden-true" : "gereden-false"}>{gereden ? 'Ja' : "Nee"}</span></p>
                <p>{amount}</p>
                <p>{toDutchValue(bedrag)}</p>
                <p>{toDutchValue(bonus)}</p>
                <p>{toDutchValue(totaalBedrag)}</p>
                {
                    isExpandable ?
                        <button className="salary__dropdownBtn" onClick={toggleTrueFalse}>
                            <img src={DropdownArrow} className={isVisible ? 'opened' : null}></img>
                        </button>
                        :
                        null
                }
            </div>
            {isExpandable && isVisible ? <SalaryExpandDetails expandedDetails={expandedDetails} /> : null}
        </div>
    )
}

export default Salary
