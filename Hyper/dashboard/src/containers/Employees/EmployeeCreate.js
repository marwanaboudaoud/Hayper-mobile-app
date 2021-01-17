import React, { useEffect } from 'react';
import { connect } from 'react-redux';
import Layout from '../../components/Layout'
import {fetchAllProjects} from '../../actions/projectAction';
import {withRouter} from "react-router";
import EmployeeDetailHeader from "../../components/EmployeeDetail/EmployeeDetailHeader";
import EmployeeDetailFunction from "../../components/EmployeeDetail/EmployeeDetailFunction";
import EmployeeDetailProjects from "../../components/EmployeeDetail/EmployeeDetailProjects";
import EmployeeDetailPersonal from "../../components/EmployeeDetail/EmployeeDetailPersonal";
import EmployeeDetailContract from '../../components/EmployeeDetail/EmployeeDetailContract';
import EmployeeDetailContact from '../../components/EmployeeDetail/EmployeeDetailContact';
import EmployeeDetailFinancial from '../../components/EmployeeDetail/EmployeeDetailFinancial';
import EmployeeDetailAddress from '../../components/EmployeeDetail/EmployeeDetailAddress';
import { createEmployee } from '../../actions/employeeActions';
import { fetchGenders } from '../../actions/genderActions';
import { fetchNationlities } from '../../actions/nationlityActions';
import { fetchCountries } from '../../actions/countryActions';
import { fetchMarital } from '../../actions/maritalActions';

const EmployeeDetail = ({countries,fetchMarital,fetchCountries,fetchNationlities,fetchGenders,createEmployee,data}) => {
  
    const handleSubmit = e =>{
        e.preventDefault();
        createEmployee(data)
    }

    useEffect(() => {
       if(countries.length === 0){
            fetchGenders();
            fetchNationlities();
            fetchCountries();
            fetchMarital();
       }
    }, [])

        return (
            <Layout>
                <div className='employee-detail-block'>
                    <form onSubmit={e => handleSubmit(e)}>
                        <EmployeeDetailHeader title={<b>Medewerker toevoegen</b>}/>
                        <EmployeeDetailFunction />
                        <EmployeeDetailProjects  />
                        <EmployeeDetailPersonal />
                        <EmployeeDetailAddress/>
                        <EmployeeDetailContact/>
                        <EmployeeDetailContract/>
                        <EmployeeDetailFinancial/>
                    </form>
                </div>
            </Layout>
        )

}

function mapStateToProps(state) {
    return {
        loading: state.projects.loading,
        countries: state.countries.countries,
        projects: state.projects.projects,
        data : state.employees.employeeFormData,
    };
}

export default withRouter(connect(mapStateToProps,{fetchGenders,fetchAllProjects,createEmployee,fetchMarital,fetchCountries,fetchNationlities})(EmployeeDetail))