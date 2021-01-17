import React from 'react'
import TableHeader from './TableHeader'
import { If, Then } from "react-if";


const TableHeaders = ({ headers, search, extensions, disableSearch }) => {
    const findExtenstion = string => extensions.find(el => el === string);
    const headerData = [...headers].map((header, i) => (
        <TableHeader key={i} search={search}>
            {header}
        </TableHeader>
    ))
    return (
        <If condition={disableSearch !== true}>
            <Then>
                {headerData}
                <If condition={typeof findExtenstion('prolong') !== 'undefined'}>
                    <TableHeader key={25}>
                        Verlengen
                    </TableHeader>
                </If>
            </Then>
        </If>
    )
}
export default TableHeaders