import React, { useEffect } from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const Index = () => {
    return (
        <Layout>
           <Table api={'projects/'} title={'Orders'} extensions={['date','importData','exportData','add']} blacklist={['partner_id']}/>
        </Layout>
    )
}

export default Index
