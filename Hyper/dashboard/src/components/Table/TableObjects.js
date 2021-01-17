import React from 'react'
import TableData from './TableData'
import TableProps from './TableProps'

const TableObjects = ({objects}) => 
    Object.values(objects).map((prop,i) =>(
        <TableData key={i} menu={true}>
            <TableProps prop={prop} />
        </TableData>
    ))


export default TableObjects
