import React from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const Index = () => {
    return (
        <Layout>
           <Table 
           api={'salaries/'} 
           title={'Salaris'} 
           extensions={['date','watch']}
           whitelist={[
                {id: 'ID'},
                {employee_name: 'Medewerker'},
                {date: 'Datum'},
                {heading: 'Rubriek'},
                {description: 'Omschrijving'},
                {salary: 'Bedrag'},
            ]}
            
           />
        </Layout>
    )
}

export default Index
