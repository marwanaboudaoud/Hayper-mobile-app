import React from 'react'
import { getFilterMonthsWithYear } from '../../utils/Date';
import { translateKeys } from '../../utils/translateKeys';

const TableMonths = () => 
     getFilterMonthsWithYear().map(({month,monthNumber,isDefault},i) => {
         return(
            <option value={monthNumber} key={i} selected={isDefault}>
                {translateKeys(month)}
            </option>
         )
     });

export default TableMonths
