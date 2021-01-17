import React from 'react'
import TableExtensions from './TableExtensions'

const TableTop = ({title,extensions}) => {
    return (
        <div className="table__top">
            <h1>{title}</h1>
            <TableExtensions extensions={extensions}/>
        </div>
    )
}

export default TableTop
