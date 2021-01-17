import React, { useEffect } from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const Index = () => {
    return (
        <Layout>
           <Table
            api={'subscriptions/'} 
            title={'Abonnementen'} 
            extensions={['add','delete','watch']}
            whitelist={[
                {id: 'ID'},
                {project_name: 'Project'},
                {code: 'Code'},
                {duration_in_months: 'Abonnementsduur in maanden'},
                {title: 'Titel'},
                {bijverkoop: 'Bijverkoop'},
            ]}
            />
        </Layout>
    )
}

export default Index
