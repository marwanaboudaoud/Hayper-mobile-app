import React, { useEffect } from 'react'
import './style.scss';
import Navigation from "../../containers/Navigation";
import { fetchGenders } from '../../actions/genderActions';
import { fetchNationlities } from '../../actions/nationlityActions';
import { fetchCountries } from '../../actions/countryActions';
import { fetchMarital } from '../../actions/maritalActions';
import { connect } from 'react-redux';
import { fetchProjects } from '../../actions/userActions';
import Errors from './Errors';

const Layout = ({app,children, loading,fetchGenders,fetchNationlities,fetchCountries,fetchMarital,countries,fetchProjects,fixed}) => {
    useEffect(() =>{
        if(countries.length === 0){
            console.log(countries)
            fetchGenders();
            fetchNationlities();
            fetchCountries();
            fetchMarital();
            fetchProjects()
        }
    },[])
    return (
        <div className={'layout'}>
            <Navigation/>
            <Errors/>
            <div id={'scroll'} className={'layout__content ' + (loading ? ' layout__content-loading':' ') + (fixed === true ? ' layout__fixed ' : '')}>{children}</div>
        </div>
    )
};

const mapStateToProps = state =>({
    countries: state.countries.countries,
    app: state.app,
})

export default connect(mapStateToProps,{fetchNationlities,fetchMarital,fetchGenders,fetchCountries,fetchProjects})(Layout);