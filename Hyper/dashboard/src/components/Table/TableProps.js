import React from 'react'
import { If,Then, Else } from 'react-if'
import TableBoolean from './TableBoolean'
import { formatToDutch,validateDate} from '../../utils/Date'
import { toDutchValue } from '../../utils/helpers'
const TableProps = ({prop}) => {
   return(
        <>
            <If condition={typeof(prop) === 'object'}>
                <Then>
                    {prop ? prop.name : ''}
                </Then>
                    
            </If>
            <If condition={typeof(prop) === 'function'}>
                <Then>
                    {prop}
                </Then>
                    
            </If>
            <If condition={typeof(prop) === 'string'}>
                <Then>
                    {validateDate(prop) ? formatToDutch(prop) : prop }
                </Then>
            </If>
            <If condition={typeof(prop) === 'number' && prop % 1 == 0 }>
                <Then>
                   {prop}
                </Then>
            </If>
            <If condition={typeof(prop) === 'number' && prop % 1 != 0 }>
                <Then>
                   {toDutchValue(prop)}
                </Then>
            </If>
            <If condition={typeof(prop) === 'boolean'}>
                <Then>
                 <TableBoolean boolean={prop} />
                </Then>
            </If>
            <If condition={Array.isArray(prop)}>
                <Then>
                   -
                </Then>
            </If>
        </>
   )
}

export default TableProps
