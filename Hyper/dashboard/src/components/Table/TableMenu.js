import React,{useState,useRef} from 'react'
import TableDots from './TableDots'
import { If } from 'react-if'
import useOuterClickNotifier from '../../utils/useOuterClickNotifier';
import {connect} from 'react-redux';
import {deleteTableRow,downloadContract,watchContract} from '../../actions/tableActions';
import {withRouter} from 'react-router-dom';
import { resetToOriginal } from '../../utils/filter';

const TableMenu = ({whiteList,history,extensions,deleteTableRow,watchContract,downloadContract,children,children:{props:{objects}}}) => {
    const [open, toggleOpen] = useState(false)
    const innerRef = useRef();
    useOuterClickNotifier(e => toggleOpen(false),innerRef);
    const getId = () => {
        const {id} = resetToOriginal(objects,whiteList);
        console.log(id)
        return id;

    };
    const handleWatch = () => history.push(`${history.location.pathname}/toevoegen/${getId()}`)

    const handleDelete = () => {
        toggleOpen(false);
        deleteTableRow(getId());
    }

    const handleDownload = () => {
       toggleOpen(false);
       downloadContract(getId())
    }

    const handleWatchContract = () => {
        watchContract(getId())
        toggleOpen(false)
    }

    const findExtenstion = string => extensions.find(el => el === string);
    const filteredExtension = () => extensions.filter(el => el !== 'prolong');
    return (
        <If condition={filteredExtension().length > 0}>
            <td style={{display:'block',position: 'relative'}}>
                <div className="table__menu-wrap">
                    <TableDots toggleOpen={() => toggleOpen(!open)}/>
                    <If condition={open}>
                        <div ref={innerRef} className="table__menu">
                            <If condition={typeof findExtenstion('watch') !== 'undefined'}>
                                <div onClick={() => handleWatch()} className="table__menu-item">Bekijken</div>
                            </If>
                            <If condition={typeof findExtenstion('watchDownload') !== 'undefined'}>
                                <div onClick={() => handleWatchContract()} className="table__menu-item">Bekijken</div>
                            </If>
                            <If condition={typeof findExtenstion('delete') !== 'undefined'}>
                                <div onClick={() => handleDelete()} className="table__menu-item">Verwijderen</div>
                            </If>
                            <If condition={typeof findExtenstion('download') !== 'undefined'}>
                                <div onClick={() => handleDownload()} className="table__menu-item">Downloaden</div>
                            </If>
                        </div>
                    </If>
                </div>
            </td>
        </If>
    )
}
const mapStateToProps = state => ({
    whiteList: state.table.data.whitelist
})
export default withRouter(connect(mapStateToProps,{deleteTableRow,downloadContract,watchContract})(TableMenu))
