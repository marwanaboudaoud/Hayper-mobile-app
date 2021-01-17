import React, { useState } from 'react'
import Polygon from '../../assets/img/icons/polygon.svg'
import {updateTableSorting,setBodyLoading} from '../../actions/tableActions';
import {connect} from 'react-redux';
import { translateKeys } from '../../utils/translateKeys';

const TableTitle = ({title,updateTableSorting,setBodyLoading}) => {
    const [order,setOrder] = useState(null)

    const handleClick = () => {
        setBodyLoading()
        updateTableSorting(title);
    };

    return (
        <div className="table__title">
            <span>{translateKeys(title)}</span>
            <div onClick={() => handleClick()} className="table__order">
                <img className="table__order-up" src={Polygon}/>
                <img className="table__order-down" src={Polygon}/>
            </div>
        </div>
    )
}

export default connect(null,{updateTableSorting,setBodyLoading})(TableTitle)
