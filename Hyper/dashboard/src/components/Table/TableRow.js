import React from 'react'
import {If, Then,Else} from 'react-if'                
import TableMenu from './TableMenu'
import Fade,{withReveal} from 'react-reveal';
import { Ring } from 'react-spinners-css';

const TableRow = ({children,options,extensions,loading}) => { 
    return (
            <tr className={"table__row" + (loading ? " table__row-loading" : ' ')}>
                {children}
                <If condition={loading}>
                   <Then>
                    <td style={{position:'relative'}}>
                        <Ring className={'pure-spinner table__ring'} size={20} color={'#F7972E'}/>
                    </td>
                   </Then>
                   <Else>
                    <If condition={typeof(options) !== 'undefined' ? true : false}>
                        <Then>
                            <TableMenu extensions={extensions} children={children}/>
                        </Then>
                    </If>
                   </Else>
                </If>
            </tr>
    )
};


export default TableRow
