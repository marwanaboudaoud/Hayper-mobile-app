import React, { useEffect } from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const Index = () => {
    return (
        <Layout>
           <Table api={'projects/'} title={'Projecten'} extensions={['add','delete','watch']}
           whitelist={[
               {id : "ID"},
               {name : "Titel"},
               {partner_name : "Klant"},
               {is_active : "Actief"},
               
           ]}/>
        </Layout>
    )
}

export default Index
