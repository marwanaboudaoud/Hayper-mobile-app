import React from 'react'
import Layout from '../../components/Layout'
import KlantForm from './KlantForm';

const KlantEdit = ({history,match:{params:{id}}}) => {
    return(
        <Layout>
            <KlantForm id={id} history={history} update={true}/>
        </Layout>
    )
}

export default KlantEdit;
