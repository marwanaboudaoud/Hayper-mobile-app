import React, { useEffect } from 'react'
import Input from '../Input';
import Btn from "../Btn";
import Icon from "../Icon";
import crossIcon from '../../assets/img/icons/green-cross.svg';
import Dropdown from "../Dropdown";
import {connect} from 'react-redux'
import { addToForm,getEmployeeFormData } from '../../actions/employeeActions';
import Checkbox from '../Checkbox';
import { If ,Then,Else} from 'react-if';
import Spinner from '../Spinner'

const EmployeeDetailPersonal = ({genderLoad,addToForm,getEmployeeFormData,dataLoading,genders,nationalities,nationalityLoad,countries,countriesLoad,maritals,maritalsLoad}) => {
    return (
        <div className="employee-detail-block__tab">
            <h2>Persoonlijke informatie</h2>
            <If condition={dataLoading || genderLoad || nationalityLoad || countriesLoad || maritalsLoad}>
                <Then>
                    <Spinner/>
                </Then>
                <Else>
                    <div className="row">
                        <div className="col-xs-6">
                            <div className="row">
                                <div className="col-xs-6">
                                    <Dropdown defaultValue={getEmployeeFormData('gender_id')  || genders.length !== 0 ? genders[0].id : ''} name={'gender_id'} label={'Geslacht'} onChange={(e,value) => addToForm({[e]:value})} options={genders} />
                                </div>
                                <div className="col-xs-6">
                                    <Input defaultValue={getEmployeeFormData('alias')} onChange={(e,value) => addToForm({[e]:value})} label={'Alias *'} type={'text'} name={'alias'}  />
                                </div>
                                <div className="col-xs-12">
                                    <Input defaultValue={getEmployeeFormData('initials')} required onChange={(e,value) => addToForm({[e]:value})} label={'Voorletters *'} type={'text'} name={'initials'} />
                                </div>
                                <div className="col-xs-12">
                                    <Input defaultValue={getEmployeeFormData('insertion')} onChange={(e,value) => addToForm({[e]:value})} label={'Tussenvoegsel'} type={'text'} name={'insertion'}  />
                                </div>
                                <div className="col-xs-12">
                                    <Input defaultValue={getEmployeeFormData('phone')} onChange={(e,value) => addToForm({[e]:value})} label={'Telefoon'} type={'text'} name={'phone'}/>
                                </div>
                                <div className="col-xs-12">
                                    <Input defaultValue={getEmployeeFormData('date_of_birth')} onChange={(e,value) => addToForm({[e]:value})} label={'Geboortedatum *'} type={'date'} name={'date_of_birth'}  />
                                </div>
                                <div className="col-xs-12">
                                    <Dropdown defaultValue={getEmployeeFormData('nationality_id') || nationalities.length !== 0 ? nationalities[0].id : ''} options={nationalities} onChange={(e,value) => addToForm({[e]:value})} label={'Nationaliteit *'} type={'text'} name={'nationality_id'} />
                                </div>
                                <div className="col-xs-12">
                                    <Checkbox  defaultValue={getEmployeeFormData('has_drivers_license')} onChange={(e,value) => addToForm({[e]:value})} label={'In bezit van een rijbewijs'} type={'text'} name={'has_drivers_license'} />
                                </div>
                            </div>
                        </div>
                        <div className="col-xs-6">
                            <div className="col-xs-6">
                                <Input  defaultValue={getEmployeeFormData('id')} disabled label={'Medewerker ID'} type={'text'} name={'function'}  />
                            </div>
                            {/* <div className="col-xs-6">
                                <Input disabled label={'VIP'} type={'text'} name={'function_by'}  />
                            </div> */}
                            <div className="col-xs-12">
                                <Input defaultValue={getEmployeeFormData('first_name')} required onChange={(e,value) => addToForm({[e]:value})} label={'Voornaam *'} type={'text'} name={'first_name'} />
                            </div>
                            <div className="col-xs-12">
                                <Input defaultValue={getEmployeeFormData('last_name')} required onChange={(e,value) => addToForm({[e]:value})} label={'Achternaam *'} type={'text'} name={'last_name'}/>
                            </div>
                            <div className="col-xs-12">
                                <Input defaultValue={getEmployeeFormData('email')} required onChange={(e,value) => addToForm({[e]:value})} label={'Emailadres *'} type={'text'} name={'email'}/>
                            </div>
                            <div className="col-xs-12">
                                <Dropdown defaultValue={getEmployeeFormData('country_of_birth_id') || countries.length !== 0 ? countries[0].id : ''} options={countries} onChange={(e,value) => addToForm({[e]:value})} label={'Geboorteland *'} type={'text'} name={'country_of_birth_id'} />
                            </div>
                            <div className="col-xs-12">
                            <Dropdown defaultValue={getEmployeeFormData('marital_status_id')|| maritals.length !== 0 ? maritals[0].id : ''} name={'marital_status_id'} label={'Burgerlijke staat *'} options={maritals} onChange={(e,value) => addToForm({[e]:value})} />
                            </div>
                        </div>
                    </div>
                </Else>
            </If>
    </div>
    )
};
const mapStateToProps = state => ({
    dataLoading: state.employees.employeeFormLoad,
    genders: state.genders.genders,
    genderLoad: state.genders.loading,
    nationalities: state.nationalities.nationalities,
    nationalityLoad: state.nationalities.loading,
    countries: state.countries.countries,
    countriesLoad: state.countries.loading,
    maritals: state.maritals.maritals,
    maritalsLoad: state.maritals.loading,
})
export default connect(mapStateToProps,{addToForm,getEmployeeFormData})(EmployeeDetailPersonal);
