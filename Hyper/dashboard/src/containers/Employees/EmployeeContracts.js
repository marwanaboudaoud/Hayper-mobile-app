import React, { useEffect } from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const EmployeeContracts = () => {
    return (
        <Layout>
            <Table
                api={'contracts/'}
                title={'Contracten'}
                whitelist={[
                    { id: 'ID' },
                    { employee_name: 'Medewerker' },
                    { contract_in_months: 'Soort contract' },
                    { start_date: 'Begin datum contract' },
                    { end_date: 'Eind datum contract' }
                ]}
                extensions={['download','watchDownload']} />
        </Layout>
    )
}

export default EmployeeContracts
