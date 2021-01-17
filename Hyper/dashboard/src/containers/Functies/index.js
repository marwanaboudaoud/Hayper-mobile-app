import React, { useEffect } from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const Index = () => {
    return (
        <Layout>
           <Table api={'roles/'} title={'Functies'} extensions={['add','watch','delete']} blacklist={['partner_id']}/>
        </Layout>
    )
}

export default Index
