import React,{useState, useEffect} from 'react'
import Input from '../Input';
import Dropdown from "../Dropdown";
import {connect} from 'react-redux';
import {addToForm,getEmployeeFormData} from '../../actions/employeeActions';
import { If ,Then,Else} from 'react-if';
import Spinner from '../Spinner'
import { fetchRoles } from '../../actions/rolesActions';
const EmployeeDetailFunction = ({addToForm,roles,loading,fetchRoles,dataLoading, getEmployeeFormData}) => {
    useEffect(() => {
        fetchRoles()
    },[])


    return (
        <div className="employee-detail-block__tab">
        <If condition={dataLoading || loading}>
         <Then>
             <Spinner/>
         </Then>
         <Else>
         <div className="row">
                <div className="col-xs-6">
                    <Dropdown defaultValue={getEmployeeFormData('role.id') || roles.length !== 0 ? roles[0].id : ''} required name={'role_id'} label={'Functie'} onChange={(e,value) => addToForm({[e]:value})} options={roles} />
                </div>
                {/* <div className="col-xs-6">
                    <Input defaultValue={getEmployeeFormData('alias')} onChange={(e,value) => addToForm({[e]:value})}  label={'Aangebracht door'} type={'text'} name={'alias'}  />
                </div> */}

            </div>
        </Else>
        </If>
        </div>
    )
};

const mapStateToProps = state => ({
    roles: state.roles.roles,
    loading: state.roles.loading,
    dataLoading: state.employees.employeeFormLoad,
    form: state.employees.getEmployeeFormData
})
export default connect(mapStateToProps,{addToForm,fetchRoles,getEmployeeFormData})(EmployeeDetailFunction);
