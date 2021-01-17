import React, { useState, useEffect } from 'react'
import TableRow from './TableRow'
import TableHead from './TableHead'
import TableBody from './TableBody'
import TableHeaders from './TableHeaders'
import TableDatas from './TableDatas'
import { connect } from 'react-redux';
import { If, Then, Else } from 'react-if'
import Spinner from '../../components/Spinner';
import { fetchTableData, setTableData } from '../../actions/tableActions';
import TablePagination from './TablePagination'
import TableSpinner from './TableSpinner'
import TableTop from './TableTop'
import { fetchAllPartners } from '../../actions/partnerActions'
import { fetchAllProjects } from '../../actions/projectAction'
import { fetchRoles } from '../../actions/rolesActions'
import TableError from './TableError'

const Table = ({pagination,error,custom_order_by,disableSearch, filter, deletedItem, order_by, direction, search, title, extensions, api, blacklist, whitelist, loading, bodyLoading, body, headers, setTableData, fetchTableData, page,fetchRoles }) => {
    const [initFetch, updateInitFetch] = useState(false);
    
    useEffect(() => {
        fetchAllPartners()
        fetchRoles()
        fetchAllProjects()
        setTableData({ api, blacklist, whitelist, custom_order_by });
        fetchTableData()
        updateInitFetch(true)
    }, []);

    useEffect(() => {
        if (initFetch === true) {
            fetchTableData()
        }
    }, [page])

    useEffect(() => {
        if (initFetch === true) {
            fetchTableData()
        }
    }, [filter])

    useEffect(() => {
        if (initFetch === true) {
            fetchTableData()
        }
    }, [search])

    useEffect(() => {
        if (initFetch === true) {
            fetchTableData()
        }
    }, [direction])

    useEffect(() => {
        if (initFetch === true) {
            fetchTableData()
        }
    }, [order_by])

    useEffect(() => {
        if (initFetch === true) {
            fetchTableData()
        }
    }, [deletedItem === true])

    return (
        <>
            <TableTop title={title} extensions={extensions} />
            <If condition={error}>
                <Then>
                    <TableError/>
                </Then>
                <Else>
                    <If condition={!loading}>
                                <Then>
                                    <div className="table__responsive">
                                        <table className="table">
                                            <TableHead>
                                                <TableRow>
                                                    <TableHeaders disableSearch={false} headers={headers} extensions={extensions} />
                                                </TableRow>
                                            </TableHead>
                                            <TableHead>
                                                <TableRow>
                                                    <TableHeaders disableSearch={disableSearch} search={true} headers={headers} extensions={extensions} />
                                                </TableRow>
                                            </TableHead>
                                            <TableBody>
                                                <If condition={bodyLoading === true}>
                                                    <Then>
                                                        <TableSpinner />
                                                    </Then>
                                                    <Else>
                                                        <If condition={body.length === 0}>
                                                            <Then>
                                                                <div className='table__empty'>
                                                                    <h2>Helaas geen resultaten.</h2>
                                                                    <h4>Probeer het opnieuw met een andere zoekterm.</h4>
                                                                </div>
                                                            </Then>
                                                        </If>
                                                        <Else>
                                                            <TableDatas extensions={extensions} data={body} />
                                                        </Else>
                                                    </Else>
                                                </If>
                                            </TableBody>
                                        </table>
                                    </div>
                                   <If condition={pagination !== false}>
                                        <Then>
                                            <TablePagination />
                                        </Then>
                                   </If>
                                </Then>
                            <Else>
                                <Spinner />
                            </Else>
                        </If>
                </Else>

            </If>
         </>

    )
}

const mapStateToProps = state => ({
    loading: state.table.data.loading,
    bodyLoading: state.table.data.bodyLoading,
    body: state.table.data.body,
    headers: state.table.data.headers,
    page: state.table.filters.page,
    search: state.table.filters.search,
    order_by: state.table.filters.order_by,
    direction: state.table.filters.direction,
    deletedItem: state.table.data.deletedItem,
    filter: state.table.filters.filter,
    error: state.table.data.error,
})

export default connect(mapStateToProps, { fetchAllProjects, fetchAllPartners, fetchTableData,fetchRoles ,setTableData })(Table)
