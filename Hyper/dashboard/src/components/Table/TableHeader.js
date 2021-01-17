import React from 'react'
import { If, Then, Else} from 'react-if'
import TableSearch from './TableSearch'
import TableTitle from './TableTitle'

const TableHeader = ({children,search}) => {
    return (
        <th  className="table__head">
            <If condition={typeof(search) !== 'undefined' ? true : false}>
                <Then>
                    <TableSearch value={children}/>
                </Then>
                <Else>
                    <TableTitle title={children} />
                </Else>
            </If>
           
        </th>
    )
}

export default TableHeader
