import React from 'react'
import Spinner from '../../components/Spinner';
import TableRow from './TableRow';

const TableSpinner = () => {
    return (
        <tr className="table__spinner-tr">
            <td className="table__spinner-td">
                <Spinner/>
            </td>
        </tr>
    )
}

export default TableSpinner
