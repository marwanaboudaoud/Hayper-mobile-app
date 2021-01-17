import React,{useState} from 'react'
import Layout from '../../components/Layout'
import {connect} from 'react-redux';
import Input from '../../components/Input/index'
import {storePartners} from '../../actions/partnerActions';
import KlantForm from './KlantForm';

const KlantToevoegen = ({history}) => {
    return(
        <Layout>
            <KlantForm history={history} update={false}/>
        </Layout>
    )
}

export default KlantToevoegen;
