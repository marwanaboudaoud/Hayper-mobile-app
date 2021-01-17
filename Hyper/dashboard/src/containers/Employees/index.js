import React, { useEffect } from 'react'
import Layout from '../../components/Layout'
import Table from '../../components/Table/Table'

const Index = () => {
    return (
        <Layout fixed={true}> 
            <Table
                api={'employees/'}
                title={'Medewerkers overzicht'}
                whitelist={[
                    { id: 'Persnr.' },
                    { alias: 'Alias' },
                    { first_name: 'Voornaam' },
                    { last_name: 'Achternaam' },
                    { email: 'Emailadres' },
                    { role_title: 'Functie' },
                    // { '': 'plaats' },
                    { date_of_birth: 'Geboortedatum' },
                    { has_drivers_license: 'Rijbewijs' },
                    { into_service: 'Datum in dienst' },
                    { out_of_service: 'Einddatum contract' },

                ]}
                extensions={['exportData', 'add', 'watch']} />
        </Layout>
    )
}

export default Index
