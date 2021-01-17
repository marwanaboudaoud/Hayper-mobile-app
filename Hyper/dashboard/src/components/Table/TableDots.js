import React from 'react'
import TableDot from './TableDot'

const TableDots = ({toggleOpen}) => (
        <div className="table__dots" onClick={() => toggleOpen()}>
            <TableDot/>
            <TableDot/>
            <TableDot/>
        </div>
    );

export default TableDots
