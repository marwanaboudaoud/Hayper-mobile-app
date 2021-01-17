import React, { useState, useEffect } from 'react'
import { connect } from 'react-redux';
import { signOut } from '../../actions/userActions';
import Navigation from '../Navigation';
import Layout from "../../components/Layout";
import Table from '../../components/Table/Table';

const Dashboard = ({ user, signOut }) => {
    return (
        <Layout>
            <Table
                pagination={false}
                custom_order_by={[{employee_name: 'users.first_name'}]}
                disableSearch={true}
                api={'expiring-contracts'}
                title={'Dashboard'}
                whitelist={[
                    {id:'id'},
                    {employee_name: 'Medewerker' },
                    {contract_in_months: 'Huidig contract' },
                    {end_date: 'Eind datum contract' },
                    {till_end_date_in_days: 'Uiterlijk opzegtermijn' },
                ]}
                extensions={['prolong']} />
        </Layout>
    )

};

function mapStateToProps(state) {
    return {
        authenticated: state.auth.authenticated,
        user: state.auth.user
    };
}

export default connect(mapStateToProps, { signOut })(Dashboard)