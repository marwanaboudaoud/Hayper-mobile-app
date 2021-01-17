import React, { useEffect } from 'react'
import { getYearsFromBeginningTillEnd } from '../../utils/Date';
import { updateTableFilter } from '../../actions/tableActions';
import {connect} from 'react-redux';
const TableYears = ({updateTableFilter}) => {

    useEffect(() =>{
        updateTableFilter()
    },[])

    return getYearsFromBeginningTillEnd().map(({year,isDefault},i) => {
        return(
           <option value={year} key={i} selected={isDefault}>
               {year}
           </option>
        )
    });
}


export default connect(null,{updateTableFilter})(TableYears)
