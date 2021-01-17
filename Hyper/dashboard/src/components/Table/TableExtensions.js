import React from 'react'
import {If , Then, Else} from 'react-if';
import Btn from '../Btn';
import { connect } from 'react-redux';
import {exportDataFromTable,updateTableFilterExtension} from '../../actions/tableActions';
import TableMonths from './TableMonths';
import TableYears from './TableYears';
import { withRouter } from 'react-router';
const TableExtensions = ({loading,history,extensions,exportDataFromTable,updateTableFilterExtension}) => {
    const findExtenstion = string => extensions.find(el => el === string);

    return (
        <div className="table__extensions">
        <If condition={typeof findExtenstion('add') !== 'undefined'}>
            <Btn onClick={() => history.push(`${history.location.pathname}/toevoegen`)}  type={'primary small'}>Toevoegen</Btn>
        </If>
        <If condition={typeof findExtenstion('importData') !== 'undefined'}>
        <Btn type={'secondary small'}>Importeer gegevens</Btn>
        </If>
         <If condition={typeof findExtenstion('exportData') !== 'undefined'}>
         <Btn size={20} spinnerColor={'#FBB541'} loading={loading} type={'secondary small'} onClick={() => exportDataFromTable()} second>Exporteer Gegevens</Btn>
        </If> 
        <If condition={typeof findExtenstion('date') !== 'undefined'}>
        <div className='table__group'>
            <select onChange={e => updateTableFilterExtension({month:parseInt(e.target.value)})} className="table__select">
               <TableMonths/>
            </select>
            <select  onChange={e => updateTableFilterExtension({year:parseInt(e.target.value)})} className="table__select">
                <TableYears/>
            </select>
        </div>
        </If>  
        </div>
    )
}

const mapStateToProps = state => ({
    loading:state.table.data.exportLoading
});
export default withRouter(connect(mapStateToProps,{exportDataFromTable,updateTableFilterExtension})(TableExtensions))
