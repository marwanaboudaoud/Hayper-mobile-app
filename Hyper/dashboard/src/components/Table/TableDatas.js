import React, { useState } from 'react'
import TableObjects from './TableObjects'
import TableRow from './TableRow'
import {
    CSSTransition,
    TransitionGroup,
  } from 'react-transition-group';
import {connect} from 'react-redux';
import TableProlong from './TableProlong'
import { resetToOriginal } from '../../utils/filter';
const TableDatas = ({ data, extensions,deletedItems,whiteList }) => {
    const findExtenstion = string => extensions.find(el => el === string);

    const tableData = [...data].map((data, i) =>{ 
        const revertedData = resetToOriginal(data,whiteList);
        const isDeleted = deletedItems.find(id => revertedData.id == id);
        let object = data;
                if(typeof findExtenstion('prolong') !== 'undefined'){
                    object = {...object, verlengen: () => <TableProlong data={data}/> }
                }
        return(
            <CSSTransition
            timeout={500}
            classNames="table"
            key={i}
          >
        <TableRow loading={typeof(isDeleted) === 'undefined' || !isDeleted ? false : true} key={i} extensions={extensions} options={true}>
            <TableObjects objects={object} />
        </TableRow>
        </CSSTransition>
        
    )})

    return (
        <TransitionGroup component={null}>
            {tableData}
        </TransitionGroup>
    )
}
const mapStateToProps = state => ({
    deletedItems: state.table.data.deletedItems,
    whiteList:state.table.data.whitelist,
});
export default connect(mapStateToProps,{})(TableDatas)
