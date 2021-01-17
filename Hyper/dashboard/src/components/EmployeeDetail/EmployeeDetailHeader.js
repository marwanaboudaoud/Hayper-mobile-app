import React from 'react'
import Btn from "../Btn";
import {connect} from 'react-redux';
import {withRouter} from 'react-router-dom';

const EmployeeDetailHeader = ({formLoad,history,title,loading}) => {
    return (
        <div className="employee-detail-header">
            <h1>{title}</h1>
            <div className='button-group'>
                <Btn disabled={formLoad} loading={loading} typeOf={'submit'}  type='primary small'>Opslaan</Btn>
                <Btn type='secondary small' onClick={() => history.push('/medewerkers')} >Annuleren</Btn>
            </div>
        </div>
    )
};
const mapStateToProps = state => ({
    loading : state.employees.updatingFormData,
    formLoad: state.employees.employeeFormLoad
})
export default withRouter(connect(mapStateToProps,{})(EmployeeDetailHeader));
